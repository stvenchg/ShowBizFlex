<?php

require_once("./GenericView.php");

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
                left: 310px;
                background-color: var(--panel-color);
                min-height: 100vh;
                width: calc(100% - 310px);
                padding-left: 20px;
                padding-right: 20px;
                padding-top: 17px;
                padding-bottom: 15px;
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
                <div class="nav-link nav-link-active">
                    <i class="fa-solid fa-house"></i> Vue d\'ensemble
                </div>
                <div class="nav-link">
                    <i class="fa-solid fa-users"></i> Comptes
                </div>
                <a href="./?module=auth&action=logout"><div class="nav-link nav-bottom" style="color: lightred;">
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
