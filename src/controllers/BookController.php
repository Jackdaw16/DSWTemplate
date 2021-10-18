<?php

namespace Alejandro\Library\controllers;

require 'DatabaseConnection.php';
require '../../models/Author.php';
require '../../models/Book.php';

use Alejandro\Library\models\Author;
use Alejandro\Library\models\Book;
use DateTime;
use PDO;

class BookController
{
    private DatabaseConnection $databaseContext;

    public function __construct()
    {
        $this->databaseContext = new DatabaseConnection("localhost", "library", "root", "");
    }

    public function getAllBook() {
        $books = [];

        $query = $this->databaseContext->getConnection()->prepare("select * from book b inner join author a on b.author_id = a.id");
        $query->execute();

        $response = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($response as $item) {
            $author = new Author($item->author_id, $item->full_name, new DateTime($item->birth_date));
            $book = new Book($item->id, $item->title,new DateTime($item->release_date), $author);
            array_push($books, $book);
        }

        return $books;
    }

    public function getBook(int $id) {
        $book = Book::class;

        $query = $this->databaseContext->getConnection()->prepare("select * from book b where b.id = $id inner join author a on b.author_id = a.id");
        $query->execute();

        $response = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($response as $item) {
            $author = new Author($item->author_id, $item->full_name, new DateTime($item->birth_date));
            $tempBook = new Book($item->id, $item->title,new DateTime($item->release_date), $author);

            $book = $tempBook;
        }

        return $book;
    }

    public function postBook(Book $book) {
        $query = $this->databaseContext->getConnection()->prepare("insert into book (title, release_date, author_id) value (?, ?, ?)");
        $result = $query->execute([$book->getTitle(), $book->getReleaseDate(), $book->getAuthor()->getId()]);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateBook(int $id, Book $book) {
        if ($this->getBook($id)) {
            $query = $this->databaseContext->getConnection()->prepare("update book set title=?, release_date=?, author_id=? where id=?");
            $result = $query->execute([$book->getTitle(), $book->getReleaseDate(), $book->getAuthor()->getId(), $id]);

            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function deleteBook(int $id) {
        if ($this->getBook($id)) {
            $query = $this->databaseContext->getConnection()->prepare("delete from book b where b.id = $id");
            $result = $query->execute();

            if ($result)
                return true;
            else
                return false;
        }
    }

}