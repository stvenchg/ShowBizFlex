<?php

require_once("Components/CompFooter/View_Footer.php");
require_once("Components/CompFooter/Model_Footer.php");

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

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/