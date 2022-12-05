<?php

require_once("Components/CompNavigation/Cont_Navigation.php");

class CompNavigation
{

    public function __construct()
    {
        $controller = new ContNavigation();
        $controller->exec();
    }
}

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/