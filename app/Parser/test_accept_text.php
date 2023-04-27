<?php
require_once 'vendor/autoload.php';

use Goutte\Client;

// создаем экземпляр Goutte
$client = new Client();

// отправляем GET-запрос на страницу
$crawler = $client->request('GET', 'https://www.filmstarts.de/kritiken/304599.html');

// находим элементы div с классом content-txt и выводим текст без тегов
$crawler->filter('div.content-txt')->each(function ($node) {
    echo strip_tags($node->text()) . PHP_EOL;
});
?>
