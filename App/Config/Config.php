<?php

namespace Config;


class Config
{
    // Connexion details for localhost => need to be modified for production
    static private $db_host = 'localhost';
    static private $db_name = 'mvc';
    static private $db_username = 'root';
    static private $db_password = '';

    // Allows static call of var values
    public static function getDbHost() { return self::$db_host; }
    public static function getDbName() { return self::$db_name; }
    public static function getDbUsername() { return self::$db_username; }
    public static function getDbPassword() { return self::$db_password; }
}