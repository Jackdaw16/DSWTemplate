<?php


namespace Alejandro\Library\controllers;

require 'DatabaseConnection.php';
require '../models/Author.php';

use Alejandro\Library\models\Author;
use DateTime;
use PDO;

class AuthorController
{
    private $databaseContext;

    public function __construct()
    {
        $this->databaseContext = new DatabaseConnection("localhost", "library", "root", "");
    }

    public function getAllAuthor() {
        $authors = [];

        $query = $this->databaseContext->getConnection()->prepare("select * from author");
        $query->execute();

        $response = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($response as $item) {
            $author = new Author($item->author_id, $item->full_name, new DateTime($item->birth_date));
            array_push($authors, $author);
        }

        return $authors;
    }

    public function getAuthor(int $id) {
        $author = Author::class;

        $query = $this->databaseContext->getConnection()->prepare("select * from author a where a.id = $id");
        $query->execute();

        $response = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($response as $item) {
            $tempAuthor = new Author($item->author_id, $item->full_name, new DateTime($item->birth_date));

            $author = $tempAuthor;
        }

        return $author;
    }

}