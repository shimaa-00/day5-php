<?php

class DATABASE
{

    const HOST     = "localhost";
    const DBNAME   = "employee";
    const USERNAME = "root";
    const PASSWORD = "12345";
    private static $connection;

    private function __construct()
    {
        try {
            static::$connection = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DBNAME, self::USERNAME, self::PASSWORD);
        } catch (PDOException $e) {
            echo $e->getMessage();
        };
    }
    public static function getInstance()
    {

        if (self::$connection == null) {
            new self();
        }
        return self::$connection;
    }
}
