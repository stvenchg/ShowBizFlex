<?php

require_once('Model_Profile.php');
require_once('View_Profile.php');

class ContProfile 
{
    private $view;
    private $model;
    private $action;

    public function __construct() 
    {
        $this->view = new ViewProfile();
        $this->model = new ModelProfile();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "page";
    }

    public function getAction() {
        return $this->action;
    }

    // Profile page
    public function page() {
        $this->view->show_page();
    }

    // Settings
    public function settings() {
        $this->view->show_settings();
    }

    public function exec() {
        $this->view->view();
    }
}