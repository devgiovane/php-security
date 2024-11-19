<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . "/../template");
$twig = new Environment($loader, [
//    'cache' => __DIR__ . "/../var/cache/twig",
]);
try {
    $secretKey = '12345678123456781234567812345678';
    echo $twig->render('index.html.twig', [
        'name' => 'John Doe',
        'secretKey' => $secretKey
    ]);
} catch (Exception $exception) {
    echo $exception->getMessage();
}