<?php

class PDOConnection
{
    static protected $bdd;
    
    public static function initPDO() 
    {
        $dsn = "mysql:host=localhost;dbname=showbizflex;charset=UTF8";
        try {
            self::$bdd = new PDO($dsn, 'root', '');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}