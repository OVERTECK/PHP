<?php

class Book
{
    private string $title;
    private string $author;
    private int $ublishedYear;
    private string $genre;

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getUblishedYear()
    {
        return $this->ublishedYear;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function setTitle(string $title)
    {
        if (!is_string($title)) {
            throw new TypeError("Атрибут должен быть строкой.");
        }

        if (empty($title)) {
            throw new ValueError("Атрибут 'name' не должен быть пустым.");
        }

        $this->title = $title;
    }

    public function setAuthor(string $author)
    {
        if (is_string($author)) {
            throw new TypeError("Атрибут должен быть строкой.");
        }

        if (empty($value)) {
            throw new ValueError("Атрибут 'author' не должен быть пустым.");
        }

        $this->author = $author;
    }

    public function setUblishedYear(int $ublishedYear)
    {
        if (is_integer($ublishedYear)) {
            throw new TypeError("Атрибут должен быть целым числом.");
        }

        if (empty($ublishedYear)) {
            throw new ValueError("Атрибут 'ublishedYear' не должен быть пустым.");
        }

        if ($ublishedYear <= 0) {
            throw new ValueError("Значение атрибута не должно быть меньше или равно нулю.");
        }

        $this->ublishedYear = $ublishedYear;
    }

    public function setGenre(string $genre)
    {
        if (is_string($genre)) {
            throw new TypeError("Атрибут должен быть строкой.");
        }

        if (empty($genre)) {
            throw new ValueError("Атрибут 'genre' не должен быть пустым.");
        }

        $this->genre = $genre;
    }


    public function __construct($title, $author, $ublishedYear, $genre)
    {
        $this->setTitle($title);
        $this->setAuthor($author);
        $this->setUblishedYear($ublishedYear);
        $this->setGenre($genre);
    }

    public function getBookInfo()
    {
        return "$this->title, $this->author, $this->ublishedYear, $this->ublishedYear";
    }
}
