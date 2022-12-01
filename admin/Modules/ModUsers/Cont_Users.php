<?php

require_once('Model_Users.php');
require_once('View_Users.php');

class ContUsers
{
    private $view;
    private $model;
    private $action;

    public function __construct() 
    {
        $this->view = new ViewUsers();
        $this->model = new ModelUsers();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "overview";
    }

    public function getAction() {
        return $this->action;
    }

    public function overview() {
        $this->view->show_overview($this->model->getUserListString());
    }

    public function exec() {
        $this->view->view();
    }
}