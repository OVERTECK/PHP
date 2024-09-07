<?php

require_once "D:\Projects\PHP\\3 kurs\pract_1\app\Book.php";
require_once "D:\Projects\PHP\\3 kurs\pract_1\app\Library.php";

$books = [];

for ($i = 1; $i < 10; $i++) {
    array_push($books, new Book("title: $i", "author: $i", $i, "genre: $i"));
}

$my_library = new Library($books);

$my_book = new Book("Добавленная книга", "Я", 2024, "Ужасы");

$my_library->addBook($my_book);

print_r($my_library->listAllBooks());

print_r($my_library->findBooksByAuthor("Я"));

// $my_library->removeBookByTitle("Добавленная книга");

// print_r($my_library->findBooksByAuthor("Я"));
