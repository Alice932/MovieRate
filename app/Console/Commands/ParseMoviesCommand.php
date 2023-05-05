<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Goutte\Client;
use App\Models\Movie;
use \Dejurin\GoogleTranslateForFree;
use Illuminate\Support\Facades\DB;

class ParseMoviesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:movies';

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

        $baseUrl = "https://www.filmstarts.de/kritiken/filme-alle/";
        $movieNum = 1;

        // All pages 6486. 15 movies per page
        $maxPages = 1;
        $pageNumber = DB::table('last_pages')->where('type', '=', 'movies')->pluck('page_number')->first();

        for ($i = $pageNumber; $i < $pageNumber + $maxPages; $i++) { // Loop over two pages for scraping
            $url = $baseUrl . "?page=" . $i;

            $crawler = $client->request('GET', $url); // Make a GET request to a URL and store the response in $crawler object

            $links = $crawler->filter('a[href^="/kritiken/"]')->extract(['href']); // Use a CSS selector to extract all the links that contain "/kritiken/" in their href attribute
            $links = array_filter($links, function ($link) { // Filter out the links that do not match the specified pattern
                return preg_match('/^\/kritiken\/\d+\.html$/', $link);
            });
            dump('Movies page - ' . $i);
            foreach ($links as $link) {  // Loop over each link and extract the required data
                $newClient = new Client();
                $newCrawler = $newClient->request('GET', 'https://www.filmstarts.de' . $link);

                dump('Movie ' . $movieNum . ' Link - ' . 'https://www.filmstarts.de'  . $link);
                $movieNum++;

                // Use a CSS selector to extract the first script element of type "application/ld+json" and store its text content in $jsonScript
                $jsonScript = $newCrawler->filter('script[type="application/ld+json"]')->first()->text();
                $jsonData = json_decode($jsonScript, true);

                // Extract the movie info from the $jsonData array, if it exists
                $title = $jsonData['name'] ?? '-';

                $imageUrl = $jsonData['image']['url'] ?? '-';

                $directorName = $jsonData['director']['name'] ?? '-';

                $actors = [];

                $actorsData = $jsonData['actor'] ?? [];
                foreach ($actorsData as $actorData) {
                    $actors[] = $actorData['name'] ?? '-';
                }
                $actorsString = implode(', ', $actors);

                $ratingValue = $jsonData['aggregateRating']['ratingValue'] ?? '-';

                $format = $jsonData['@type'] ?? '-';

                $content = $newCrawler->filter('.section.ovw.ovw-synopsis .content-txt')->each(function ($node) {
                    return $node->text();
                });
                $contentString = implode(" ", $content);

                $genre = $jsonData['genre'] ?? '-';
                if (is_array($genre)) {
                    $genre = implode(', ', $genre);
                }

                $duration = $jsonData['duration'] ?? '-';

                if ($duration !== '-') {
                    preg_match('/PT(\d+)H(\d+)M/i', $duration, $matches);
                    $hours = $matches[1] ?? '00';
                    $minutes = $matches[2] ?? '00';
                    $duration = ($hours . "h " . $minutes . "min");
                } else {
                    $duration = '-';
                }

                $year = $newCrawler->filter('.date')->first()->text();
                preg_match('/(\d{1,2}\.\s(?:Jan(?:uar)?|Feb(?:ruar)?|März|Apr(?:il)?|Mai|Jun(?:i)?|Jul(?:i)?|Aug(?:ust)?|Sep(?:tember)?|Okt(?:ober)?|Nov(?:ember)?|Dez(?:ember)?)\s\d{4})/', $year, $matches);
                if (count($matches) > 0) {
                    $year = $matches[1];
                } else {
                    $year = '-';
                }

                // Translate extracted data from German to English using Fake Google Translate API

                $source = 'de';
                $target = 'en';
                $attempts = 5;
                $arr = [$title, $genre, $contentString, $year];

                $tr = new GoogleTranslateForFree();
                $english_text = $tr->translate($source, $target, $arr, $attempts);

                //Create or update movie in database with the extracted and translated data

                $movie = Movie::firstOrCreate([
                    'title' => ucfirst($english_text[0]),
                ], [
                    'year' => $english_text[3],
                    'time' => $duration,
                    'director' => $directorName,
                    'genre' => $english_text[1],
                    'rating' => $ratingValue,
                    'actors' => $actorsString,
                    'content' => $english_text[2],
                    'format' => $format,
                    'image' => $imageUrl,
                ]);

                if ($title) {
                    echo ('"' . $english_text[0] . '"' . ' parsed with status Success' . "\n\n");
                }
            }
        }
        DB::table('last_pages')
            ->where('type', '=', 'movies')
            ->update([
                'page_number' => $i,
                'url' => $link
            ]);
        return ('Movies parsed successfully!');

    }
}
