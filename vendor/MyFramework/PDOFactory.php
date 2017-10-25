<?php

namespace MyFramework;

use Config\Config;

class PDOFactory
{
    private $db_name;
    private $db_username;
    private $db_password;
    private $db_host;
    private $pdo;

    public function __construct()
    {
        $this->db_name = Config::getDbName();
        $this->db_username = Config::getDbUsername();
        $this->db_password = Config::getDbPassword();
        $this->db_host = Config::getDbHost();
    }

    // Connexion to database
    public function getPDO()
    {
        // Avoid multiple db connexion for the various queries
        if ($this->pdo === null)
        {
            try
            {
                $pdo = new \PDO("mysql:dbname=$this->db_name;host=$this->db_host", $this->db_username, $this->db_password);
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $this->pdo = $pdo;
            }
            catch (\Exception $e)
            {
                die('Error : ' . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}