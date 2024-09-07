<?php

class Library
{
    private array $books;

    public function __construct(array $books)
    {
        $this->books = $books;
    }

    public function addBook(Book $book): void
    {
        array_push($this->books, $book);
    }

    public function removeBookByTitle(string $title): void
    {

        foreach ($this->books as $index => $book) {
            if ($book->getTitle() === $title) {
                unset($this->books[$index]);
                return;
            }
        }

        throw new ValueError("Данная книга не найдена.");
    }

    public function findBooksByAuthor(string $author): array
    {
        $result = [];

        foreach ($this->books as $book) {
            if ($book->getAuthor() === $author) {
                $result[] = $book;
            }
        }

        return $result;
    }

    public function listAllBooks(): array
    {
        return $this->books;
    }
}
