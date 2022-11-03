<?php

namespace Components\CompFooter;

require_once("./Components/CompFooter/Cont_Footer.php");
use Components\CompFooter\ContFooter;

class CompFooter
{

    public function __construct()
    {
        $controller = new ContFooter();
        $controller->exec();
    }
}
