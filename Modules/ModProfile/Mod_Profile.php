<?php

require_once "Cont_Profile.php";
include_once "PDOConnection.php";

class ModProfile extends PDOConnection
{

    private $controller;

    public function __construct()
    {
        $this->controller = new ContProfile();

        switch ($this->controller->getAction()) 
        {
            case "page":
                $this->controller->page();
            break;
            case "settings":
                $this->controller->settings();
            break;
        }

        $this->controller->exec();
    }
}