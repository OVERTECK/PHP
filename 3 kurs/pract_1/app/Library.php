<?php

class Library {
    private array $books;

    public function __construct($books) {
        $this->books = $books;
    }

    public function addBook(Book $book)
    {
        array_push($this->books, $book);
    }

    public function removeBookByTitle($title) {
        
        foreach ($this->books as $book) {
            if ($book === $title) {
                array_diff($this->books, $title);
            }
        }
        
        throw new ValueError("Данная книга не найдена.");   
    }

    public function findBooksByAuthor($author) {
        $result = [];

        foreach ($this->books as $index => $book) {
            if ($book->author === $author) {
                array_push($result, $book);
            }
        }

        return $result;
    }

    public function listAllBooks() {
        return $this->books;
    }
}