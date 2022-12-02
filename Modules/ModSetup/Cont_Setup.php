<?php

require_once('Model_Setup.php');
require_once('View_Setup.php');

class ContSetup 
{
    private $view;
    private $model;
    private $action;

    public function __construct() 
    {
        $this->view = new ViewSetup();
        $this->model = new ModelSetup();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "genres";
    }

    public function getAction() {
        return $this->action;
    }

    // Setup page
    public function genres() {
        $this->view->show_selectGenres();
    }

    public function exec() {
        $this->view->view();
    }
}