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
        $this->view = '<nav class="navbar navbar-dark navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="./">ShowBizFlex.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="#"><i class="fa-solid fa-magnifying-glass"></i> Rechercher</a>
                    <a class="nav-link" href="#"><i class="fa-solid fa-arrow-trend-up"></i> Tendances</a>
                    <a class="nav-link" href="#"><i class="fa-solid fa-ranking-star"></i> Top 100</a>
                </div>
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="./?module=auth&action=login"><button type="button" class="btn btn-link"><i class="fa-solid fa-right-to-bracket"></i> Connexion</button></a>
                    <a class="nav-link" href="./?module=auth&action=register"><button type="button" class="btngradient btngradient-hover color-9">S\'inscrire</button></a>
                </div>
            </div>
        </div>
    </nav>';
    }

    public function view()
    {
        echo $this->view;
    }
}
