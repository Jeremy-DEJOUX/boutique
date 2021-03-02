<?php

namespace App\Db;
use PDO;
use PDOException;

class Db extends PDO
{
    //Instance unique de la classes
    private static $instance;

    //Information de connexiones
    private const DBHOST = 'localhsot';
    private const DBUSER = 'root';
    private const DBPASS = 'pass';
    private const DBNAME = 'boutique';

    private function __construct()
    {
        //DSN de connexion
        $_dsn = 'mysql:dbname' . self::DBNAME . ';host=' . self::DBHOST;

        // On appelle le constructeru de class PDO
        try {
            parent::__construct($_dsn, self::DBUSER, self::DBPASS);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8'); //Permet de faire les transiotion en UTF-8
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //Tous les FETCH seront en Tableau Associatif
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Declenche une exccetpion dés qu'il y'a un problème

        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public static function getInstance():self
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }
}