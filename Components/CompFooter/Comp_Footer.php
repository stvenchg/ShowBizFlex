<?php

require_once("./Components/CompFooter/Cont_Footer.php");

class CompFooter
{

    public function __construct()
    {
        $controller = new ContFooter();
        $controller->exec();
    }
}
