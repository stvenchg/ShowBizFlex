<?php

require_once('Model_Settings.php');
require_once('View_Settings.php');

class ContSettings 
{
    private $view;
    private $model;
    private $action;

    public function __construct() 
    {
        $this->view = new ViewSettings();
        $this->model = new ModelSettings();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "profile";
    }

    public function getAction() {
        return $this->action;
    }

    // Settings
    public function profile() {
        $this->view->show_settingsProfile();
    }

    public function account() {
        $this->view->show_settingsAccount();
    }


    // Settings - Avatar ou photo de profil
    public function uploadAvatar() {
        $this->view->show_uploadAvatar();
    }

    public function sendUploadAvatar() {
        $this->model->sendUploadAvatar();
    }

    public function deleteCurrentAvatar() {
        $this->model->deleteCurrentAvatar();
    }

    // Settings - Bannière
    public function uploadBanner() {
        $this->view->show_uploadBanner();
    }

    public function sendUploadBanner() {
        $this->model->sendUploadBanner();
    }

    public function deleteCurrentBanner() {
        $this->model->deleteCurrentBanner();
    }

    // Settings - Details utilisateur
    public function updateAbout() {
        $this->model->updateAbout();
    }

    public function updateUsername() {
        $this->model->updateUsername();
    }

    public function updateEmail() {
        $this->model->updateEmail();
    }

    // Settings - Sécurité
    public function security() {
        $this->view->show_settingsSecurity();
    }

    public function exec() {
        $this->view->view();
    }
}