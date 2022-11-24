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
        $this->view = '<nav class="navbar navbar-dark navbar-expand-lg" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="./"><span class="gradient-brand-blue">Show</span><span class="gradient-brand-gray">BizFlex</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>';

            if (!isset($_SESSION['login'])) {
                $this->view = $this->view . '<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" id="searchbutton"><i class="fa-solid fa-magnifying-glass"></i> Rechercher</a>
                    <a class="nav-link" href="#"><i class="fa-solid fa-compass"></i> Explorer</a>
                </div>';
            }
            else {
                $this->view = $this->view . '<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="#"><i class="fa-solid fa-compass"></i> Explorer</a>
                    <a class="nav-link" href="#"><i class="fa-solid fa-heart"></i> Ma liste</a>
                </div>';
            }

        if (!isset($_SESSION['login'])) {
            $this->view = $this->view . '<div class="navbar-nav ms-auto" id="navbar">
                    <a class="nav-link" href="./?module=auth&action=login"><button type="button" class="btn btn-link"><i class="fa-solid fa-right-to-bracket"></i> Connexion</button></a>
                    <a class="nav-link nav-button" href="./?module=auth&action=register"><button type="button" class="btngradient btngradient-hover color-9">S\'inscrire</button></a>
                </div>
            </div>
        </div>
    </nav>';
        } else {
            $this->view = $this->view . '<div class="navbar-nav ms-auto">
                    <a class="nav-link" id="searchbutton"><i class="fa-solid fa-magnifying-glass"></i></a>
            <div class="avatar" id="avatar" onclick="toggleMenu()" style="background: url(\'../Assets/images/avatar/' . $_SESSION['avatar_file'] . '\');"></div>
                </div>
                    <div id="submenu" class="sub-menu-wrap">
                        <div class="sub-menu">
                            <div class="user-info">
                                <h5>Salut, ' . $_SESSION['login'] . ' !</h5>';

            if (!isset($_SESSION['is_admin'])) {
                $this->view = $this->view . '<label><i class="fa-solid fa-crown"></i> MEMBRE PREMIUM</label>
                </div>
            <hr>

                <a href="./?module=profile" class="sub-menu-link">
                    <i class="fa-solid fa-user"></i> Profil
                </a>

                <a href="#" class="sub-menu-link">
                    <i class="fa-solid fa-bell"></i> Notifications
                </a>

                <a href="./?module=settings" class="sub-menu-link">
                    <i class="fa-solid fa-gear"></i> Paramètres
                </a>';
            }
            else {
                $this->view = $this->view . '<label style="color:#ba3c29"><i class="fa-solid fa-shield"></i> ADMINISTRATEUR</label>
                </div>
            <hr>

                <a href="./?module=profile" class="sub-menu-link">
                    <i class="fa-solid fa-user"></i> Profil
                </a>

                <a href="#" class="sub-menu-link">
                    <i class="fa-solid fa-bell"></i> Notifications
                </a>

                <a href="./?module=settings" class="sub-menu-link">
                    <i class="fa-solid fa-gear"></i> Paramètres
                </a>';
            }

            if (isset($_SESSION["is_admin"])) {
                $this->view = $this->view . '
                
                <a href="#" class="sub-menu-link">
                    <i class="fa-solid fa-shield"></i> Administration
                </a>
                
                <a class="nav-link" href="./?module=auth&action=logout"><button type="button" class="btngradient btngradient-hover color-9-s">Se déconnecter</button></a>
        </div>
    </div>
</div>
</div>
</nav>';
            } else {
                $this->view = $this->view . '
                  
                <a class="nav-link" href="./?module=auth&action=logout"><button type="button" class="btngradient btngradient-hover color-9-s">Se déconnecter</button></a>
        </div>
    </div>
</div>
</div>
</nav>';
        }
    }
}

    public function view()
    {
        echo $this->view;
    }
}
