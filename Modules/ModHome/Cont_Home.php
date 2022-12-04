<?php

require_once('Model_Home.php');
require_once('View_Home.php');

class ContHome
{
    private $view;
    private $model;
    private $action;

    public function __construct() 
    {
        $this->view = new ViewHome();
        $this->model = new ModelHome();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "home";
    }

    public function getAction() {
        return $this->action;
    }

    public function home() {
        $this->view->sitePresentation();

        echo '<div class="home">';
            $this->view->featured();
            $this->view->trendingThisWeek();
            $this->view->topRated();
            $this->view->userRecommandations();
        echo '</div>';
    }

    public function exec() {
        $this->view->view();
    }
}