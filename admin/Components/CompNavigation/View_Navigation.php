<?php

require_once("./GenericView.php");

class ViewNavigation extends GenericView
{
    private $view;

    public function __construct()
    {
        parent::__construct();
    }

    public function navigation()
    {
        if (isset($_SESSION['admin_id'])) {
            $this->view = '<div class="">

            </div>';
        }
    }

    public function view()
    {
        echo $this->view;
    }
}
