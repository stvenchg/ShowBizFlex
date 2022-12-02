<?php

require_once('Model_Shows.php');
require_once('View_Shows.php');

class ContShows
{
    private $view;
    private $model;
    private $action;

    public function __construct() 
    {
        $this->view = new ViewShows();
        $this->model = new ModelShows();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "show";
    }

    public function getAction() {
        return $this->action;
    }

    public function overview() {
        $this->view->show_overview();
    }

   
    public function deleteCom(){
        $this->model->deleteComments();
    }

    public function exec() {
        $this->view->view();
    }
}