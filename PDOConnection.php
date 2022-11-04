<?php

class PDOConnection
{
    static protected $db;
    
    public static function initPDO() 
    {
        $dsn = "mysql:localhost;dbname=showbizflex;charset=UTF8";
        try {
            self::$db = new PDO($dsn, 'root', '');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}