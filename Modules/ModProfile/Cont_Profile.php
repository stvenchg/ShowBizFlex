<?php

require_once('Model_Profile.php');
require_once('View_Profile.php');

class ContProfile 
{
    private $view;
    private $model;
    private $action;

    public function __construct() 
    {
        $this->view = new ViewProfile();
        $this->model = new ModelProfile();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "myProfile";
    }

    public function getAction() {
        return $this->action;
    }

    public function viewProfile(){
        $this->view->show_profile($this->model->getUserDetails(), 
        $this->model->getUserShowInListsCount(), 
        $this->model->getUserComments(),
        $this->model->getUserActivity(),
        $this->model->verifcationfollowedsUsers());
    }

    public function exec() {
        $this->view->view();
    }
}

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/