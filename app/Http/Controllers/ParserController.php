<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

class ParserController extends Controller
{
  public function parsePage($url)
  {
      // Создаем экземпляр клиента Goutte
      $client = new Client();

      // Переходим на страницу
      $crawler = $client->request('GET', $url);

      // Получаем текст статьи
      $articleText = $crawler->filter('.content-txt')->first()->text();

      // Возвращаем текст статьи
      return response($articleText);
  }

  public function getLinks()
  {
      // Создаем экземпляр клиента Guzzle
      $guzzleClient = new GuzzleClient();

      // Отправляем GET-запрос на страницу со списком статей
      $response = $guzzleClient->get('https://www.filmstarts.de/kritiken/');

      // Получаем HTML-код страницы
      $html = $response->getBody()->getContents();

      // Создаем экземпляр парсера DOM
      $dom = new \DOMDocument();

      // Загружаем HTML-код страницы в парсер
      @$dom->loadHTML($html);

      // Создаем экземпляр клиента Goutte
      $client = new Client();

      // Получаем список ссылок на статьи
      $links = [];
      foreach ($dom->getElementsByTagName('a') as $node) {
          $href = $node->getAttribute('href');
          if (strpos($href, '/kritiken/') !== false) {
              $links[] = 'https://www.filmstarts.de' . $href;
          }
      }

      // Парсим каждую страницу и сохраняем текст статей в файлы
      foreach ($links as $link) {
          $this->parsePage($link);
      }

      // Возвращаем список ссылок
      return response()->json($links);
  }
}
