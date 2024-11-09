<?php

declare(strict_types=1);

namespace App;

require_once 'vendor\autoload.php';

$myFabric = new FileManagerFabric();


$txtMan = $myFabric->createTXTManager();

var_dump($txtMan->readFile("files/file.txt"));

$txtMan->writeFile("files/file.txt", "1, 2, 4, 5, 6, 7");

var_dump($txtMan->readFile("files/file.txt"));


$csvManager = $myFabric->createCSVManager();

var_dump($csvManager->readFile("files/file.csv"));

$csvManager->setSplitterRead('!');

$csvManager->writeFile("files/file.csv", "123!23!21!12223");

var_dump($csvManager->readFile("files/file.csv"));


$jsonManager = $myFabric->createJSONManager();

var_dump($jsonManager->readFile("files/file.json"));

$jsonManager->writeFile("files/file.json", '[{"name": "Oleg", "age: 22"}]');

var_dump($jsonManager->readFile("files/file.json"));