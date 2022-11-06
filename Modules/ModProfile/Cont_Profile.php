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
        $this->action = isset($_GET['action']) ? $_GET['action'] : "view";
    }

    public function getAction() {
        return $this->action;
    }

    // Profile page
    public function profile() {
        $this->view->show_profile();
    }

    public function exec() {
        $this->view->view();
    }
}