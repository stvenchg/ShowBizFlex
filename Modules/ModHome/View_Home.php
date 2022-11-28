<?php

require_once("./GenericView.php");
require_once("Alert.php");
require_once("Model_Home.php");

class ViewHome extends GenericView
{

    private $viewAlert;
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->viewAlert = new Alert;
        $this->model = new ModelHome;
    }

    public function show_home()
    {

        if (!isset($_SESSION['login'])) {
            echo '        <div class="alpha-alert">
            
        <h1>Bienvenue sur ShowBizFlex !</h1>

        <p>Tu es actuellement sur une version démonstrative et en cours de développement.<br>Connectez-toi ou inscris-toi pour faire disparaître ce message.</p>

        <p style="color: green;">Dernière mise à jour : 17/11/2022</p>
        </div>';
        }

        echo '<div class="home">';
        $this->featured();
        $this->trendingThisWeek();
        $this->topRated();
        echo '</div>';
    }

    public function trendingThisWeek() {
        $res = $this->model->getTmdbTrending();

        echo '        <!-- Les séries en tendances actuellement -->
        <h4 class="trending-heading">TENDANCES MAINTENANT</h4>
        <ul id="autoWidthTrending" class="cs-hidden">';

        foreach($res['results'] as $value) {

            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];

            echo '<li class="item-' . $value['id'] . '">
            <div class="trending-box">
                <a href="?module=shows&action=overview&id='. $value['id'].'"><img src="' . $fullPosterPath . '"></a>
            </div>
        </li>';

        }

        echo  '</ul>';
    }

    public function featured() {

        $res = $this->model->getTmdbPopular();

        echo '<!-- Séries mise en avant -->
        <ul id="autoWidthFeatured" class="cs-hidden">';

        foreach($res['results'] as $value) {

            $fullBackdropPath = "https://image.tmdb.org/t/p/w780/" . $value['backdrop_path'];

            echo '<li class="item-' . $value['id'] . '">
            <div class="featured-box">
                <a href="?module=shows&action=overview&id='. $value['id'].'"><img src="' . $fullBackdropPath . '"></a>
            </div>
        </li>';

        }

        echo  '</ul>';
    }

    public function topRated() {

        $res = $this->model->getTmdbTopRated();

        echo '<!-- Les séries les mieux notés -->
        <h4 class="toprated-heading">LES MIEUX NOTÉS CETTE SAISON</h4>

        <ul id="autoWidthTopRated" class="cs-hidden">';

        foreach($res['results'] as $value) {

            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];

            echo '<li class="item-' . $value['id'] . '">
            <div class="toprated-box">
                <a href="?module=shows&action=overview&id='. $value['id'].'"><img src="' . $fullPosterPath . '"></a>
            </div>
        </li>';

        }

        echo  '</ul>';
    }
}
