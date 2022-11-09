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

    // Settings - Details utilisateur
    public function updateUserDetails() {
        $this->model->updateUserDetails();
    }


    public function exec() {
        $this->view->view();
    }
}