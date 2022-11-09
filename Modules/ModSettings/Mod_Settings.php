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
            case "profile":
                $this->controller->profile();
            break;
            case "account":
                $this->controller->account();
            break;
            case "uploadAvatar":
                $this->controller->uploadAvatar();
            break;
            case "sendUploadAvatar":
                $this->controller->sendUploadAvatar();
            break;
            case "deleteCurrentAvatar":
                $this->controller->deleteCurrentAvatar();
            break;
            case "uploadBanner":
                $this->controller->uploadBanner();
            break;
            case "updateUserDetails":
                $this->controller->updateUserDetails();
            break;
        }

        $this->controller->exec();
    }
}