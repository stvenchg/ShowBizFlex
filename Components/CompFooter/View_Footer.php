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
        <p>© 2022 ShowBizFlex. Tous droits réservés. <a>Mentions légales</a>   <a>CGU</a>    <a>Aide</a></p>
    </div>';
    }

    public function view()
    {
        echo $this->view;
    }
}
