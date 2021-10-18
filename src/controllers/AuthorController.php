<?php


namespace Alejandro\Library\controllers;

require 'DatabaseConnection.php';
require '../models/Author.php';

use Alejandro\Library\models\Author;
use DateTime;
use PDO;

class AuthorController
{
    private DatabaseConnection $databaseContext;

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

    public function postAuthor(Author $author) {
        $query = $this->databaseContext->getConnection()->prepare("insert into author (full_name, birth_day) value (?, ?)");
        $result = $query->execute([$author->getFullName(), $author->getBirthDay()]);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAuthor(int $id, Author $author) {
        if ($this->getAuthor($id)) {
            $query = $this->databaseContext->getConnection()->prepare("update author set full_name=?, birth_day=? where id=?");
            $result = $query->execute([$author->getFullName(), $author->getBirthDay(), $id]);

            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function deleteAuthor(int $id) {
        if ($this->getAuthor($id)) {
            $query = $this->databaseContext->getConnection()->prepare("delete from author a where a.id = $id");
            $result = $query->execute();

            if ($result)
                return true;
            else
                return false;
        }
    }

}