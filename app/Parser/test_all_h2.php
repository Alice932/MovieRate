<?php
require_once 'vendor/autoload.php'; // загружаем автозагрузчик Composer

use Goutte\Client; // импортируем класс для работы с HTTP-запросами

function parsePage($url) {
    $client = new Client(); // создаем клиент для работы с HTTP-запросами
    $crawler = $client->request('GET', $url); // делаем GET-запрос на указанный URL и получаем DOM-объект

    $titles = array();
    $crawler->filter('h2')->each(function ($node) use (&$titles) { // находим заголовки h2 и добавляем их в массив
        $title = $node->text();
        $titles[] = $title;
    });

    return $titles;
}

$url = 'https://www.filmstarts.de/kritiken/304599.html'; // адрес страницы для парсинга
$titles = parsePage($url); // запускаем парсинг
print_r($titles); // выводим заголовки на экран
?>
