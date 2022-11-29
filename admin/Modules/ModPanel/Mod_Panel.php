<?php

require_once "Cont_Panel.php";
include_once "PDOConnection.php";

class ModPanel extends PDOConnection
{

    private $controller;

    public function __construct()
    {
        $this->controller = new ContPanel();

        switch ($this->controller->getAction()) 
        {
            case "overview":
                $this->controller->overview();
            break;
        }

        $this->controller->exec();
    }
}