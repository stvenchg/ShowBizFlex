<?php

require_once("./GenericView.php");

class ViewFooter extends GenericView
{
    private $view;

    public function __construct()
    {
        parent::__construct();
    }

    public function Footer()
    {
        $this->view = '<div class="footer-content">
        <div class="footer-brand">
            <h3 class="copyright">© 2022</h3>
            <a href="./"><span class="gradient-brand-blue">Show</span><span class="gradient-brand-gray">BizFlex</span></a>
            <h3 class="thanksTmdb">Propulsé par </h3>
            <a href="https://www.themoviedb.org/"><img src="Assets/images/tmdb.png" alt="TMDB"></a>
        </div>

        <div class="footer-links">
        <div class="footer-link">
            <h2 class="footer-section-title">Aide & Information</h2>
            <a href="#">À propos de nous</a><br>
            <a href="#">Contactez-nous</a><br>
            <a href="#">Centre d\'assistance</a><br>
            <a href="#">Plan du site</a>
        </div>

        <div class="footer-link">
            <h2 class="footer-section-title">Réseaux sociaux</h2>
            <a href="#">Discord</a><br>
            <a href="#">Twitter</a><br>
            <a href="#">Facebook</a><br>
            <a href="https://github.com/DUT-Info-Montreuil/ShowBizFlex" target="_blank">GitHub</a>
        </div>

        <div class="footer-link">
            <h2 class="footer-section-title">Mentions légales</h2>
            <a href="#">Conditions générales</a><br>
            <a href="#">Confidentialité et cookies</a>
            <a href="#">Accessibilité</a>
        </div>
        </div>
        </div>';
    }

    public function view()
    {
        echo $this->view;
    }
}
