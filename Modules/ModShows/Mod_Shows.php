<?php

require_once "Cont_Shows.php";
include_once "PDOConnection.php";

class ModShows extends PDOConnection
{

    private $controller;

    public function __construct()
    {
        $this->controller = new ContShows();

        switch ($this->controller->getAction()) 
        {
            case "show":
                $this->controller->show();
            break;
        }

        $this->controller->exec();
    }
}