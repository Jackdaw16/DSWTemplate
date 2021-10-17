<?php

namespace Alejandro\Library\controllers;

require 'DatabaseConnection.php';
require '../models/Book.php';
require '../models/Author.php';

use Alejandro\Library\models\Author;
use Alejandro\Library\models\Book;
use DateTime;
use PDO;

class BookController
{
    private $databaseContext;

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

    public function getAuthor(int $id) {
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

}