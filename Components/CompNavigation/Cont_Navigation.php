<?php

namespace Components\CompNavigation;

require_once("./Components/CompNavigation/View_Navigation.php");
require_once("./Components/CompNavigation/Model_Navigation.php");

use Components\CompNavigation\ViewNavigation;
use Components\CompNavigation\ModelNavigation;

class ContNavigation
{

    private $view;
    private $model;

    public function __construct()
    {
        $this->view = new ViewNavigation();
        $this->model = new ModelNavigation();
    }

    public function exec()
    {
        $this->view->navigation();
        $this->view->view();
    }
}