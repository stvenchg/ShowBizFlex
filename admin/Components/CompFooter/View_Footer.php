<?php

require_once("./GenericView.php");

class ViewFooter extends GenericView
{
    private $view;

    public function __construct()
    {
        parent::__construct();
    }

    public function Footer()
    {
        $this->view = '';
    }

    public function view()
    {
        echo $this->view;
    }
}
