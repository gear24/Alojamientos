<?php

namespace Config;

use PDO;
use PDOException;

class Database
{
    private static $connection = null;

    public static function getConnection()
    {
        if (self::$connection === null) {
            try {
                $host = 'localhost';
                $dbname = 'alojamientos';
                $user = 'root';
                $password = 'root';

                self::$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Error de conexión: " . $e->getMessage(); // Debug
                die("Error de conexión: " . $e->getMessage());
                
            }
        }

        return self::$connection;
    }
}
