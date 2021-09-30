<?php

class DBConn
{
    protected const DB_SERVER = 'localhost';
    protected const DB_USER = 'admin2';
    protected const DB_PASSWORD = 'Mirodenii1!';
    protected const DB_DATABASE = 'usersDB';
    public $dbCon;

    public function __construct() {
        $user = $this::DB_USER;
        $pass = $this::DB_PASSWORD;
        $server = $this::DB_SERVER;
        $database = $this::DB_DATABASE;

        try {
            $this->dbCon = new PDO("mysql:host=$server; dbname=$database; charset=utf8", $user, $pass);
            $this->dbCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->dbCon;
        } catch (PDOException $err) {
            echo "Error: " . $err->getMessage(). "<br />";
            die();
        }
    }
    public function dbClose() {
        $this->dbCon = null;
    }
}