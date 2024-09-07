<?php

class Book {
    private string $title;
    private string $author;
    private int $ublishedYear;
    private string $genre;

    public function __get($property)
    {
        switch ($property)
        {
            case "title":
                return $this->title;
            case "author":
                return $this->author;
            case "ublishedYear":
                return $this->ublishedYear;
            case "genre":
                return $this->genre;
            default:
                throw new ValueError("Данный атрибут не найден.");
        }
    }

    public function __set($name, $value) {

        switch ($name) {
            
            case "title":

                if (!is_string($value)) {
                    throw new TypeError("Атрибут должен быть строкой.");
                }

                if (empty($value)) {
                    throw new ValueError("Атрибут 'name' не должен быть пустым.");
                }

                $this->title = $value;

                break;

            case "author":
                if (is_string($value)) {
                    throw new TypeError("Атрибут должен быть строкой.");
                }

                if (empty($value)) {
                    throw new ValueError("Атрибут 'author' не должен быть пустым.");
                }
                
                $this->author = $value;
                break;

            case "ublishedYear":
                if (is_integer($value)) {
                    throw new TypeError("Атрибут должен быть целым числом.");
                }

                if (empty($value)) {
                    throw new ValueError("Атрибут 'ublishedYear' не должен быть пустым.");
                }

                if ($value <= 0) {
                    throw new ValueError("Значение атрибута не должно быть меньше или равно нулю.");
                }
                
                $this->ublishedYear = $value;
                break;
            
            case "genre":
                if (is_string($value)) {
                    throw new TypeError("Атрибут должен быть строкой.");
                }

                if (empty($value)) {
                    throw new ValueError("Атрибут 'genre' не должен быть пустым.");
                }
                
                $this->genre = $value;
                break;

            default:
                throw new ValueError("Данный атрибут не найден.");
        }
    }

    public function __construct($title, $author, $ublishedYear, $genre) {
        $this->__set("title", $title);
        $this->__set("author", $author);
        $this->__set("ublishedYear", $ublishedYear);
        $this->__set("genre", $genre);
    }

    public function getBookInfo() {
        return "$this->title, $this->author, $this->ublishedYear, $this->ublishedYear";
    }
}