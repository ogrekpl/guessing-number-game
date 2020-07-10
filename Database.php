<?php

class Database
{
    //private $host = "localhost";
    private $host = "mysql.cba.pl";
    private $db_name = "ogrekpl";
    private $username = "ogrekpl";
    private $password = "PiGw1sd.";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}