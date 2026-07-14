<?php

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "portofolio_db";

    public function connect()
    {
        $conn = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->dbname
        );

        if ($conn->connect_error) {
            die("Koneksi gagal : " . $conn->connect_error);
        }

        return $conn;
    }
}