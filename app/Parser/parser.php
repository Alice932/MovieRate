<?php
require_once 'vendor/autoload.php';

use Goutte\Client;
use \Dejurin\GoogleTranslateForFree;

$client = new Client();


for ($i = 1; ; $i++) {
    $url = "https://www.filmstarts.de/kritiken/$i.html";
    $crawler = $client->request('GET', $url);

    if ($crawler->filter('.content-txt')->count() > 0) {
        $title = $crawler->filter('.titlebar-title')->first()->text();
        $date = $crawler->filter('.meta-body-info')->first()->text();
        $director = $crawler->filter('.meta-body-direction')->first()->text();
        $date = $crawler->filter('.meta-body-info')->first()->text();
        $content = $crawler->filter('.content-txt')->first()->text();

        $source = 'de';
        $target = 'en';
        $attempts = 5;
        $arr = [$title, $date, $director, $content];

        $tr = new GoogleTranslateForFree();
        $english_text = $tr->translate($source, $target, $arr, $attempts);

        echo "\n";
        echo "Title: ";
        echo($english_text[0]);
        echo "\n";
        echo "Date: ";
        echo($english_text[1]);
        echo "\n";
        echo "Director: ";
        echo($english_text[2]);
        echo "\n";
        echo "Content: ";
        echo($english_text[3]);
        echo "\n";
        // Обработка контента статьи

    } else {
        continue;
    }
}
?>
