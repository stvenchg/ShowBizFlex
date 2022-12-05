<?php

require_once("GenericView.php");

class ViewNavigation extends GenericView
{
    private $view;

    public function __construct()
    {
        parent::__construct();
    }

    public function navigation()
    {
        if (isset($_SESSION['admin_id'])) {

            echo '<style>main {
                position: relative;
                left: 330px;
                background-color: var(--panel-color);
                min-height: 100vh;
                width: calc(100% - 330px);
                padding-left: 50px;
                padding-right: 50px;
                padding-top: 50px;
                padding-bottom: 50px;
                transition: var(--tran-05);
            }
            </style>';

            $this->view = '<nav>
            <div class="navLogo">
                <a class="navbar-brand" href="./"><span class="gradient-brand-blue">Show</span><span class="gradient-brand-gray">BizFlex / Admin</span></a>
            </div>
            <div class="navUserGreeting">
                <h1>Bonjour, ' . $_SESSION['admin_username'] . '.</h1>
                <h2>Dernière connexion le : null</h2>
            </div>
            <div class="nav-items">
                <a href="./"><div class="nav-link">
                    <i class="fa-solid fa-house"></i> Vue d\'ensemble
                </div></a>
                <a href="./?module=users"><div class="nav-link">
                    <i class="fa-solid fa-users"></i> Utilisateurs
                </div></a>
                <a href="../"><div class="nav-link nav-bottom-2">
                    <i class="fa-solid fa-arrow-left"></i> Retourner à ShowBizFlex
                </div></a>
                <a href="./?module=auth&action=logout"><div class="nav-link nav-bottom">
                    <i class="fa-solid fa-right-from-bracket"></i> Se déconnecter
                </div></a>
            </div>
    </nav>';
        }
    }

    public function view()
    {
        echo $this->view;
    }
}

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/