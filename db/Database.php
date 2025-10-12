<?php

class Database {
    private $conn;

    public function __construct() {
        $host = getenv('DB_HOST') ? getenv('DB_HOST'): "localhost";
        $dbname = getenv('DB_NAME') ? getenv('DB_NAME'): "TP-Sistemas-nro1";
        $user = getenv('DB_USER') ? getenv('DB_USER'): "root";
        $pass = getenv('DB_PASS') ? getenv('DB_PASS'): "";
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $this->conn = new PDO($dsn, $user, $pass);
    }

    public function getConnection() {
        return $this->conn;
    }

}

