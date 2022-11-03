<?php

namespace Components\CompFooter;

require_once("./Components/CompFooter/View_Footer.php");
require_once("./Components/CompFooter/Model_Footer.php");

use Components\CompFooter\ViewFooter;
use Components\CompFooter\ModelFooter;

class ContFooter
{

    private $view;
    private $model;

    public function __construct()
    {
        $this->view = new ViewFooter();
        $this->model = new ModelFooter();
    }

    public function exec()
    {
        $this->view->Footer();
        $this->view->view();
    }
}