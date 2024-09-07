<?php

class Book
{
    private string $title;
    private string $author;
    private int $ublishedYear;
    private string $genre;

    public function __construct(string $title, string $author, int $ublishedYear, string $genre)
    {
        $this->setTitle($title);
        $this->setAuthor($author);
        $this->setUblishedYear($ublishedYear);
        $this->setGenre($genre);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getUblishedYear(): int
    {
        return $this->ublishedYear;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function setTitle(string $title): void
    {
        if (!is_string($title)) {
            throw new TypeError("Атрибут должен быть строкой.");
        }

        if (empty($title)) {
            throw new ValueError("Атрибут 'name' не должен быть пустым.");
        }

        $this->title = $title;
    }

    public function setAuthor(string $author): void
    {
        if (!is_string($author)) {
            throw new TypeError("Атрибут должен быть строкой.");
        }

        if (empty($author)) {
            throw new ValueError("Атрибут 'author' не должен быть пустым.");
        }

        $this->author = $author;
    }

    public function setUblishedYear(int $ublishedYear): void
    {
        if (!is_integer($ublishedYear)) {
            throw new TypeError("Атрибут должен быть целым числом.");
        }

        if ($ublishedYear <= 0) {
            throw new ValueError("Значение атрибута не должно быть меньше или равно нулю.");
        }

        $this->ublishedYear = $ublishedYear;
    }

    public function setGenre(string $genre): void
    {
        if (!is_string($genre)) {
            throw new TypeError("Атрибут должен быть строкой.");
        }

        if (empty($genre)) {
            throw new ValueError("Атрибут 'genre' не должен быть пустым.");
        }

        $this->genre = $genre;
    }

    public function getBookInfo(): string
    {
        return "$this->title, $this->author, $this->ublishedYear, $this->ublishedYear";
    }
}
