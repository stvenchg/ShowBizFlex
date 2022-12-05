<?php

require_once("Components/CompNavigation/View_Navigation.php");
require_once("Components/CompNavigation/Model_Navigation.php");

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

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/