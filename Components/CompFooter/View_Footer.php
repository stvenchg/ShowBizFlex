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
        $this->view = '<div class="container">
        <p>ShowBizFlex © Tous droits réservés 2022</p>
    </div>';
    }

    public function view()
    {
        echo $this->view;
    }
}