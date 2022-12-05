<?php

require_once("GenericView.php");
require_once("Alert.php");
require_once("Model_Lists.php");

class ViewLists extends GenericView
{

    private $viewAlert;
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->viewAlert = new Alert;
        $this->model = new ModelLists;
    }

    public function showLists() {
        if(!isset($_SESSION['login'])) {
            $this->viewAlert->userNotAuthenticated();
        }else{
            echo '<div class="lists">';
            $this->followedShows();
            $this->toWatchLaterShows();
            $this->recommendations();
            echo '</div>';
        }
    }

    public function followedShows() {
        $res = $this->model->getFollowedShows();
    
        echo '<!-- Les séries suivies -->
        <h4 class="trending-heading">SERIES SUIVIES</h4>
        <ul id="autoWidthTrending" class="cs-hidden">';

        foreach($res as $value) {

            $details = $this->model->getDetails($value['idShow']);

            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $details['poster_path'];

            echo '<li class="item-' . $value['idShow'] . '">
            <div class="trending-box">
                <a href="?module=shows&action=overview&id='. $value['idShow'].'"><img src="' . $fullPosterPath . '"></a>
            </div>
        </li>';

        }

        echo  '</ul>';
    }

    public function toWatchLaterShows() {
        $res = $this->model->getToWatchLaterShows();
    
        echo '<!-- Les séries à regarder plus tard -->
        <h4 class="toprated-heading">SERIES A REGARDER PLUS TARD</h4>
        <ul id="autoWidthTopRated" class="cs-hidden">';

        foreach($res as $value) {

            $details = $this->model->getDetails($value['idShow']);

            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $details['poster_path'];

            echo '<li class="item-' . $value['idShow'] . '">
            <div class="toprated-box">
                <a href="?module=shows&action=overview&id='. $value['idShow'].'"><img src="' . $fullPosterPath . '"></a>
            </div>
        </li>';

        }

        echo  '</ul>';
    }

    public function recommendations() {
        $res = $this->model->getRecommendations();
    
        if ($res != null) {

            echo '<!-- Recommandations en fonction des séries suivies -->
            <h4 class="latest-heading">ON TE RECOMMANDE CES SERIES</h4>
            <ul id="autoWidthLatest" class="cs-hidden">';

            foreach($res as $value) {

                $details = $this->model->getDetails($value['id']);

                $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $details['poster_path'];

                echo '<li class="item-' . $value['id'] . '">
                <div class="latest-box">
                    <a href="?module=shows&action=overview&id='. $value['id'].'"><img src="' . $fullPosterPath . '"></a>
                </div>
            </li>';

            }

            echo  '</ul>';
        }
    }
}

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/
