<?php

namespace Config;


class Config
{
    static private $db_host = 'localhost';
    static private $db_name = 'mvc';
    static private $db_username = 'root';
    static private $db_password = '';

    /**
     * @return string
     */
    public static function getDbHost()
    {
        return self::$db_host;
    }

    /**
     * @return string
     */
    public static function getDbName()
    {
        return self::$db_name;
    }

    /**
     * @return string
     */
    public static function getDbUsername()
    {
        return self::$db_username;
    }

    /**
     * @return string
     */
    public static function getDbPassword()
    {
        return self::$db_password;
    }

}