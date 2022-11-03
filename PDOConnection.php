<?php

class PDOConnection
{
    public function __construct() 
    {}

    protected static $db;
    
    public static  function initConnection() 
    {
        self::$db = new PDO('mysql:localhost;dbname=showbizflex','root','');
    }
}