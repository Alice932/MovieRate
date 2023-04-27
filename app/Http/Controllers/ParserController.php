<?php

namespace App\Http\Controllers;

use Goutte\Client;
use App\Models\Movie;
use Illuminate\Http\Request;
use \Dejurin\GoogleTranslateForFree;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
class ParserController extends Controller
{
    public function parseMovies(Request $request)
    {
        // Создаем экземпляр клиента Goutte
        $client = new Client();

        // Определяем URL-адрес сайта, с которого хотим парсить информацию
        $url = 'https://www.filmstarts.de/kritiken/filme-alle/';

        // Получаем страницу с фильмами
        $crawler = $client->request('GET', $url);

        // Получаем список ссылок на страницы с фильмами
        $links = $crawler->filter('a[href^="/kritiken/"]')->extract(['href']);
        $links = array_filter($links, function($link) {
            return preg_match('/^\/kritiken\/\d+\.html$/', $link);
        });
        // Проходим по каждой странице и получаем необходимую информацию
        dump($links);
        foreach ($links as $link) {
            $newClient = new Client();
            $newCrawler = $newClient->request('GET', 'https://www.filmstarts.de' . $link);

            echo $newCrawler->getUri();
            dump($link);
            dump($newCrawler);

            $jsonScript = $newCrawler->filter('script[type="application/ld+json"]')->first()->text();
            $jsonData = json_decode($jsonScript, true);

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



            // echo($contentString);
            // echo gettype($title);
            // echo gettype($imageUrl);
            // echo gettype($directorName);
            // echo gettype($actorsString);
            // echo gettype($ratingValue);
            // echo gettype($format);
            // echo gettype($genre);
            // echo gettype($contentString);


            // $source = 'de';
            // $target = 'en';
            // $attempts = 5;
            // $arr = [$title, 'Manta'];
            // echo $title;

            // $tr = new GoogleTranslateForFree();
            // $english_text = $tr->translate($source, $target, $arr, $attempts);

            // dd("Title: ");
            // echo($english_text[0]);
            // echo($title);
            $source = 'de';
            $target = 'en';
            $attempts = 5;
            $arr = [$title, $genre, $contentString];

            $tr = new GoogleTranslateForFree();
            $english_text = $tr->translate($source, $target, $arr, $attempts);

            echo "Title: ";
            echo($english_text[0]);
            $movie = new Movie();
            $movie->title = $title;
            $movie->year = '2001';
            $movie->time = '21m';
            $movie->director = $directorName;
            $movie->genre = $english_text[1];
            $movie->rating = $ratingValue;
            $movie->actors = $actorsString;
            $movie->content = $english_text[2];
            $movie->format = $format;
            $movie->image = $imageUrl;
            $movie->save();

        }
        return response()->json(['message' => 'Movies parsed successfully!']);
    }
}
