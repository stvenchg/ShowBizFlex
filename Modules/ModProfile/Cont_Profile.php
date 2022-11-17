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
        $this->action = isset($_GET['action']) ? $_GET['action'] : "viewProfile";
    }

    public function getAction() {
        return $this->action;
    }

    public function profile() {
        $this->view->show_profile($this->model->getUserDetails());
    }

    public function othersProfile(){

    }

    public function exec() {
        $this->view->view();
    }
}