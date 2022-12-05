<?php

require_once("Components/CompFooter/Cont_Footer.php");

class CompFooter
{

    public function __construct()
    {
        $controller = new ContFooter();
        $controller->exec();
    }
}

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/