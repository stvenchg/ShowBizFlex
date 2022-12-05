<?php

class PDOConnection
{
    static protected $db;
    
    public static function initPDO() 
    {
        $dsn = "mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201637;charset=UTF8";
        try {
            self::$db = new PDO($dsn, 'dutinfopw201637', 'suqebamu');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/