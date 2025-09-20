<?php

class Database {
    private $conn;

    public function __construct() {
        // TODO: Get credentials from env variables
        $dsn = "mysql:host=localhost;dbname=test;charset=utf8mb4";
        $this->conn = new PDO($dsn, 'root', '');
    }

    public function getConnection() {
        return $this->conn;
    }

}

