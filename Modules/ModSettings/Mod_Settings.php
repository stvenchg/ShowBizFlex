<?php

require_once "Cont_Settings.php";
include_once "PDOConnection.php";

class ModSettings extends PDOConnection
{

    private $controller;

    public function __construct()
    {
        $this->controller = new ContSettings();

        switch ($this->controller->getAction()) 
        {
            case "main":
                $this->controller->settings();
            break;
            case "uploadAvatar":
                $this->controller->uploadAvatar();
            break;
            case "sendUploadAvatar":
                $this->controller->sendUploadAvatar();
            break;
        }

        $this->controller->exec();
    }
}