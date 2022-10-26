<?php

namespace Components\CompNavigation;

require_once("./GenericView.php");
use GenericView;

class ViewNavigation extends GenericView
{
    private $view;

    public function __construct()
    {
        parent::__construct();
    }

    public function navigation()
    {
        $this->view = "<h1>ShowBizFlex</h1>";
    }

    public function view()
    {
        echo $this->view;
    }
}
