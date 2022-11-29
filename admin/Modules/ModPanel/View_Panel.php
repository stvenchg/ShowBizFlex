<?php

require_once("./GenericView.php");
require_once("Alert.php");
require_once("Model_Panel.php");

class ViewPanel extends GenericView
{

    private $viewAlert;
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->viewAlert = new Alert;
        $this->model = new ModelPanel;
    }

    public function show_dashboard()
    {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: ./?module=auth&action=login");
        }
        else {
            echo 'cc';
        }
    }
}
