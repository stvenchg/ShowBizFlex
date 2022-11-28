<?php

require_once "Cont_Search.php";
include_once "PDOConnection.php";

class ModSearch extends PDOConnection
{

    private $controller;

    public function __construct()
    {
        $this->controller = new ContSearch();

        switch ($this->controller->getAction()) 
        {
            case "search":
                $this->controller->search();
            break;
        }

        $this->controller->exec();
    }
}