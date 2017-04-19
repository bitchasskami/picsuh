<?php

class connectionhandler
{
    public $host = 'localhost';
    public $username = 'root';
    public $password = '12345';
    public $dbname = "picsuh";
    private static $connection;

    public static function connect(){
        if (self::$connection === null) {

            self::$connection = new MySQLi('localhost', 'root', '12345', "picsuh");
            if (self::$connection->connect_error) {
                $error = self::$connection->connect_error;
                throw new Exception("Verbindungsfehler: $error");
            }

            self::$connection->set_charset('utf8');
        }

        return self::$connection;
    }
}