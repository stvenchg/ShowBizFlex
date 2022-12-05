<?php

class GenericView
{
    public function __construct()
    {
        ob_start();
    }

    public function getView()
    {
        return ob_get_clean();
    }

    public function view()
    {
        global $view;
        $view = $this->getView();
    }
}

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/
?>