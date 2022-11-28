<?php

class PDOConnection
{
    static protected $db;
    
    public static function initPDO() 
    {
        $dsn = "mysql:host=localhost;dbname=dutinfopw201637;charset=UTF8";
        try {
            self::$db = new PDO($dsn, 'root', '');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}