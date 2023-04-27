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

            $title = $jsonData['name'];
            $imageUrl = $jsonData['image']['url'];
            
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

            $movie = new Movie();
            $movie->title = $title;
            $movie->year = '2001';
            $movie->time = '21m';
            $movie->director = 'anybody';
            $movie->genre = 'Incrediable genre';
            $movie->rating = 4.3;
            $movie->actors = 'Any Body';
            $movie->content = 'text';
            $movie->format = 'movie';
            $movie->image = $imageUrl;
            $movie->save();

        }
        return response()->json(['message' => 'Movies parsed successfully!']);
    }
}
