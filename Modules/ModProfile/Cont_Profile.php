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
        $this->action = isset($_GET['action']) ? $_GET['action'] : "myProfile";
    }

    public function getAction() {
        return $this->action;
    }

    public function myProfile() {
        $this->view->show_myProfile($this->model->getUserDetails(), $this->model->getUserShowInListsCount());
    }

    public function viewProfile(){
        $this->view->show_viewProfile($this->model->getOtherUser(), $this->model->getUserShowInListsCount());
    }

    public function exec() {
        $this->view->view();
    }
}