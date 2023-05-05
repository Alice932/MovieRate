<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use App\Models\News;
use \Dejurin\GoogleTranslateForFree;
use DateTime;
use Illuminate\Support\Facades\DB;

class ParseNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Client();  // Create a new instance of Goutte client for web scraping

        $baseUrl = "https://www.filmstarts.de/news/";

        $newsNum = 1;

        // All pages 3017. 24 news per page
        $maxPages = 1;

        $pageNumber = DB::table('last_pages')->where('type', '=', 'news')->pluck('page_number')->first();

        for ($i = $pageNumber; $i < $pageNumber + $maxPages; $i++) { // Loop over two pages for scraping

            $url = $baseUrl . "?page=" . $i;

            $crawler = $client->request('GET', $url); // Make a GET request to a URL and store the response in $crawler object

            $links = $crawler->filter('a[href^="/nachrichten/"]')->extract(['href']); // Use a CSS selector to extract all the links that contain "/kritiken/" in their href attribute
            $links = array_filter($links, function ($link) { // Filter out the links that do not match the specified pattern
                return preg_match('/^\/nachrichten\/\d+\.html$/', $link);
            });
            dump('News page - ' . $i);

            foreach ($links as $link) {  // Loop over each link and extract the required data
                $newClient = new Client();
                $newCrawler = $newClient->request('GET', 'https://www.filmstarts.de' . $link);

                dump('New ' . $newsNum . ' Link - ' . 'https://www.filmstarts.de'  . $link);
                $newsNum++;

                // Use a CSS selector to extract the first script element of type "application/ld+json" and store its text content in $jsonScript
                $jsonScript = $newCrawler->filter('script[type="application/ld+json"]')->first()->text();
                $jsonData = json_decode($jsonScript, true, JSON_UNESCAPED_UNICODE);

                // Extract the news info from the $jsonData array, if it exists
                $title = $jsonData['headline'] ?? '-';

                $imageUrl = $jsonData['image']['url'] ?? '-';

                $date_str = $jsonData['datePublished'] ?? '-';
                $date = DateTime::createFromFormat('Y-m-d H:i:s.u', $date_str);
                $formatted_date = $date->format('Y/m/d H:i');

                $author = $jsonData['author']['name'] ?? '-';

                $format = $jsonData['@type'] ?? '-';

                $content = $newCrawler->filter('.bo-p')->each(function ($node) {
                    $text = $node->text();
                    return $text;
                });


                // Translate extracted data from German to English using Fake Google Translate API

                $source = 'de';
                $target = 'en';
                $attempts = 5;
                $arr = [$title];

                $tr = new GoogleTranslateForFree();
                $contentTr = new GoogleTranslateForFree();
                $english_content = $contentTr->translate($source, $target, $content, $attempts);
                $english_text = $tr->translate($source, $target, $arr, $attempts);

                $contentString = implode(" ", $english_content);



                //Create or update news in database with the extracted and translated data

                $news = News::firstOrCreate([
                    'title' => $english_text[0],
                ], [
                    'publishTime' => $formatted_date,
                    'author' => $author,
                    'content' => $contentString,
                    'format' => $format,
                    'image' => $imageUrl,
                ]);

                if ($title) {
                    echo ('"' . $english_text[0] . '"' . ' parsed with status Success' . "\n\n");
                }
            }
        }
        DB::table('last_pages')
        ->where('type', '=', 'news')
            ->update([
                'page_number' => $i,
                'url' => $link
            ]);
        return ('News parsed successfully!');
    }
}
