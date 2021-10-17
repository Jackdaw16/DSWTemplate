<?php


namespace Alejandro\Library\controllers;


use PDO;
use PDOException;

class DatabaseConnection
{
    private string $serverName;
    private string $databaseName;
    private string $username;
    private string $password;

    /**
     * DatabaseConnection constructor.
     * @param string $serverName
     * @param string $databaseName
     * @param string $username
     * @param string $password
     */
    public function __construct(string $serverName, string $databaseName, string $username, string $password)
    {
        $this->serverName = $serverName;
        $this->databaseName = $databaseName;
        $this->username = $username;
        $this->password = $password;
    }

    public function getConnection() {
        try {
            return $connection = new PDO("mysql:host=$this->serverName;dbname=$this->databaseName", $this->username, $this->password);
        }catch (PDOException $e) {
            print_r($e->getMessage());
            echo "uff";
            die("Could not connect to the database $this->databaseName :" . $e->getMessage());
        }
    }


}