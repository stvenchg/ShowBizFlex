<?php

namespace Components\CompNavigation;

require_once("./Components/CompNavigation/Cont_Navigation.php");
use Components\CompNavigation\ContNavigation;

class CompNavigation
{

    public function __construct()
    {
        $controller = new ContNavigation();
        $controller->exec();
    }
}
