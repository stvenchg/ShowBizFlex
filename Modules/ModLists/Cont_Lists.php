<?php

require_once('Model_Lists.php');
require_once('View_Lists.php');

class ContLists
{
    private $view;
    private $model;
    private $action;

    public function __construct() {
        $this->view = new ViewLists();
        $this->model = new ModelLists();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "lists";
    }

    public function lists() {
        $this->view->showLists();
    }

    public function getAction() {
        return $this->action;
    }

    public function exec() {
        $this->view->view();
    }
}