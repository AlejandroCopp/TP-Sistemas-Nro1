<?php

class Database {
    private $conn;

    public function __construct() {
        // TODO: Get credentials from env variables / secrets manager
        $this->conn = new mysqli('localhost', 'root', '', 'test');
    }

    public function getConnection() {
        return $this->conn;
    }

}

