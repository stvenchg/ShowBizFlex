<?php

namespace Components\CompFooter;

require_once("./GenericView.php");
use GenericView;

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
