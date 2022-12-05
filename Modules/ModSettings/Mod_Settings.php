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
            case "security":
                $this->controller->security();
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
            case "sendUploadBanner":
                $this->controller->sendUploadBanner();
            break;
            case "deleteCurrentBanner":
                $this->controller->deleteCurrentBanner();
            break;
            case "updateAbout":
                $this->controller->updateAbout();
            break;
            case "updateUsername":
                $this->controller->updateUsername();
            break;
            case "updateEmail":
                $this->controller->updateEmail();
            break;
        }

        $this->controller->exec();
    }
}

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/