<?php

namespace App\Http\Controllers;

use Goutte\Client;
use App\Models\Movie;
use Illuminate\Http\Request;
use \Dejurin\GoogleTranslateForFree;

class ParserController extends Controller
{
    public function parseMovies(Request $request)
    {
        $client = new Client();  // Create a new instance of Goutte client for web scraping

        $baseUrl = "https://www.filmstarts.de/kritiken/filme-alle/";

        for ($i = 1; $i <= 2; $i++) { // Loop over two pages for scraping
            $url = $baseUrl . "?page=" . $i;

            $crawler = $client->request('GET', $url); // Make a GET request to a URL and store the response in $crawler object

            $links = $crawler->filter('a[href^="/kritiken/"]')->extract(['href']); // Use a CSS selector to extract all the links that contain "/kritiken/" in their href attribute
            $links = array_filter($links, function($link) { // Filter out the links that do not match the specified pattern
                return preg_match('/^\/kritiken\/\d+\.html$/', $link);
            });
            dump($links);
            foreach ($links as $link) {  // Loop over each link and extract the required data
                $newClient = new Client();
                $newCrawler = $newClient->request('GET', 'https://www.filmstarts.de' . $link);

                dump($newCrawler);

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
                $genre = $jsonData['genre'] ?? '-';
                $content = $newCrawler->filter('.content-txt')->each(function ($node) {
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
                    echo $hours;
                    echo $minutes;
                    $duration = ($hours ."h " . $minutes . "min");
                } else {
                    $duration = '-';
                }

                $year = $newCrawler->filter('.date')->first()->text();
                echo($year);
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
                    'title' => $english_text[0],
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

            }
    }
        return response()->json(['message' => 'Movies parsed successfully!']);

    }
}
