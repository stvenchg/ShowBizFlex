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
            case "overview":
                $this->controller->overview();
            break;

            case"sendComments":
                $this->controller->comments();
                $this->controller->redirection();

        }

        $this->controller->exec();
    }
}