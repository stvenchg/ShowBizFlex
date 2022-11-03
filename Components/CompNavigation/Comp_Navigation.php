<?php

require_once("./Components/CompNavigation/Cont_Navigation.php");

class CompNavigation
{

    public function __construct()
    {
        $controller = new ContNavigation();
        $controller->exec();
    }
}
