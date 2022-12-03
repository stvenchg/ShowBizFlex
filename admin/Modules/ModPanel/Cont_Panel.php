<?php

require_once('Model_Panel.php');
require_once('View_Panel.php');

class ContPanel
{
    private $view;
    private $model;
    private $action;

    public function __construct() 
    {
        $this->view = new ViewPanel();
        $this->model = new ModelPanel();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "dashboard";
    }

    public function getAction() {
        return $this->action;
    }

    public function dashboard() {
        $this->view->show_dashboard($this->model->getCountUsers(), $this->model->getCountComments(), $this->model->getCountShowsInList());
    }

    public function exec() {
        $this->view->view();
    }
}