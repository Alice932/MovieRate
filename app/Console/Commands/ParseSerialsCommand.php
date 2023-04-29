<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use App\Models\Serial;
use \Dejurin\GoogleTranslateForFree;

class ParseSerialsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:serials';

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

        $baseUrl = "https://www.filmstarts.de/serien-archiv/";

        $serialNum = 1;
        $maxPages = 1;

        for ($i = 1; $i <= $maxPages; $i++) { // Loop over two pages for scraping
            $url = $baseUrl . "?page=" . $i;

            $crawler = $client->request('GET', $url); // Make a GET request to a URL and store the response in $crawler object

            $links = $crawler->filter('a[href^="/serien/"]')->extract(['href']); // Use a CSS selector to extract all the links that contain "/kritiken/" in their href attribute
            $links = array_filter($links, function ($link) { // Filter out the links that do not match the specified pattern
                return preg_match('/^\/serien\/\d+\.html$/', $link);
            });
            dump('Serial page - ' . $i);

            foreach ($links as $link) {  // Loop over each link and extract the required data
                $newClient = new Client();
                $newCrawler = $newClient->request('GET', 'https://www.filmstarts.de' . $link);

                dump('Serial ' . $serialNum . ' Link - ' . 'https://www.filmstarts.de'  . $link);
                $serialNum++;

                // Use a CSS selector to extract the first script element of type "application/ld+json" and store its text content in $jsonScript
                $jsonScript = $newCrawler->filter('script[type="application/ld+json"]')->first()->text();
                $jsonData = json_decode($jsonScript, true);

                // Extract the news info from the $jsonData array, if it exists
                $title = $jsonData['name'] ?? '-';

                $imageUrl = $jsonData['image'] ?? '-';

                $episodes = $jsonData['numberOfEpisodes'] ?? '-';

                $seasons = $jsonData['numberOfSeasons'] ?? '-';

                $creatorNode = $newCrawler->filter('.meta-body-item:contains("Creator:")')->first();
                $creator = "-";
                if ($creatorNode->count() > 0) {
                    $creator = $creatorNode->filter('a')->text();
                }

                $ratingValue = $jsonData['aggregateRating']['ratingValue'] ?? '-';

                $format = $jsonData['@type'] ?? '-';

                $content = $newCrawler->filter('.content-txt')->each(function ($node) {
                    return $node->text();
                });

                $contentString = implode(" ", $content);

                $genre = $jsonData['genre'] ?? '-';
                if (is_array($genre)) {
                    $genre = implode(', ', $genre);
                }

                // Translate extracted data from German to English using Fake Google Translate API

                $source = 'de';
                $target = 'en';
                $attempts = 5;
                $arr = [$title, $genre, $contentString];

                $tr = new GoogleTranslateForFree();
                $english_text = $tr->translate($source, $target, $arr, $attempts);

                //Create or update news in database with the extracted and translated data

                $serial = Serial::firstOrCreate([
                    'title' => ucfirst($english_text[0]),
                ], [
                    'episodes' => $episodes,
                    'seasons' => $seasons,
                    'creator' => $creator,
                    'genre' => $english_text[1],
                    'rating' => $ratingValue,
                    'content' => $english_text[2],
                    'format' => $format,
                    'image' => $imageUrl,
                ]);

                if ($title) {
                    echo ('"' . $english_text[0] . '"' . ' parsed with status Success' . "\n\n");
                }
            }
        }
        return ('Serials parsed successfully!');

    }
}
