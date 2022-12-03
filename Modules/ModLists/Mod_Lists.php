<?php

require_once "Cont_Lists.php";
include_once "PDOConnection.php";

class ModLists extends PDOConnection
{

    private $controller;

    public function __construct()
    {
        $this->controller = new ContLists();

        switch ($this->controller->getAction()) 
        {
            case "lists":
                $this->controller->lists();
            break;
        }

        $this->controller->exec();
    }
}