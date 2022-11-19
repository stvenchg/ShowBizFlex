<?php

require_once("./GenericView.php");
require_once("Alert.php");
require_once("Model_Shows.php");

class ViewShows extends GenericView
{

    private $viewAlert;
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->viewAlert = new Alert;
        $this->model = new ModelShows;
    }

    public function show_overview()
    {

        $details = $this->model->getDetails();
        $showRating = $this->model->getContentRating();
        $showTrailer = $this->model->getVideos();
        $watchProviders = $this->model->getWatchProviders();

        foreach($showTrailer['results'] as $index => $value) {
            if ($index == 0) {
                $trailer = $value['key'];
            }
        }

        $loopGenres = '';
        foreach($details['genres'] as $genre) {
            $loopGenres .= ($genre['name'] . ', ');
        }

        foreach($showRating['results'] as $index => $value) {
            if ($index == 0) {
                $rating = $value['rating'];
            }
        }

        if (isset($watchProviders['results']['FR'])) {
            $providers = array();
            foreach ($watchProviders['results']['FR']['flatrate'] as $provider) {
                array_push($providers, $provider['logo_path']);
            }
            
            $providersString = '';
            foreach ($providers as $provider) {
                $providersString .= '<img src="https://image.tmdb.org/t/p/original' . $provider . '"></img>';
            }
        }
        else {
            $providersString = "Information indisponible.";
        }

        $fullBackdropPath = "https://image.tmdb.org/t/p/original" . $details['backdrop_path'];
        $fullPosterPath = "https://image.tmdb.org/t/p/w500" . $details['poster_path'];
        $showName = $details['name'];
        $showFirstAirYear = ' (' . strtok($details['first_air_date'], '-') . ')';
        $showGenres = rtrim($loopGenres, ', ') . ' - ' . '[durée moyenne à récupérer]';
        $showSynopsis = $details['overview'];

        echo '<div class="show-box">';

        echo '<div class="header-show-container">';

        // Display backdrop
        echo '<div class="backdrop" style="background: url(\'' . $fullBackdropPath . '\'); background-size: cover;"></div>';

        // Display poster and infos
        echo '<div class="showPosterAndMainInfo">
            <div class="poster">
                <img src="' . $fullPosterPath . '"/>
            </div>
            <div class="showMainInfo">
                <h1 class="show-title">' . $showName . '<span class="show-release-date">' . $showFirstAirYear . '</span>'. '</h1>
                <span class="show-rating">' . $rating . '</span><span class="show-genres">' . $showGenres . '</span>
                <div><a target="_blank" href="https://youtube.com/embed/' . $trailer . '"><button class="showTrailerButton"><i class="fa-solid fa-play"></i>  Bande-annonce</button></a></div>
                <h3 class="section-title">Synopsis</h3>
                <p class="show-synopsis">' . $showSynopsis . '</p>
                <h3 class="section-title">Où regarder ?</h3>
                <div class="show-availability">'. $providersString . '</div>
            </div>';

        echo '</div>';

        echo '</div>';

        /*
        
        $res = $this->model->getShowDetails();

        echo '<div class="show-box">';
        echo '<div class="show-main-info">';

        $fullBackdropPath = "https://image.tmdb.org/t/p/original/" . $res['backdrop_path'];
        echo '<div class="backdrop" style="background: url(\'' . $fullBackdropPath . '\'); background-size: cover;"></div>';

        $fullPosterPath = "https://image.tmdb.org/t/p/w500/" . $res['poster_path'];
        echo '<div class="poster">
            <img src="' . $fullPosterPath . '"/>
        </div>';

        $firstAirYear = ' (' . strtok($res['first_air_date'], '-') . ')';

        echo '<div class="main-info-right">';
        echo '<h1 class="show-title">' . $res['name'] . '<span class="show-release-date">' . $firstAirYear . '</span>'. '</h1>';

        $genres = '';
        foreach($res['genres'] as $genre) {
            $genres .= ($genre['name'] . ', ');
        }

        echo rtrim($genres, ', ') . ' - ' . '[durée moyenne à récupérer]';

        echo '<br>';
        echo '<br>';
        echo($res['overview']);

        echo '</div>';

        echo '</div>';

        echo($res['tagline']);

        echo("<br>");

        if($res['in_production']) {
            echo("En cours");
            echo("<br>");
        } else {
            echo("Terminé");
            echo("<br>");
        }

        echo'<p> Dernière diffusion : '.$res['last_air_date'].'</p>' ;
        
        //A revoir

        if($res['in_production'] && $res['next_episode_to_air'] != null) {
           
            echo'<p> Prochain épisode : '.$res['next_episode_to_air']['air_date'].'</p>' ;
            
        } else {
            echo("<br>");
        }

        echo($res['overview']);
        echo("<br>");
        echo("<br>");

        echo'<p> Nombre de saisons : '.$res['number_of_seasons'].'</p>';
        echo'<p> Nombre d\'épisodes : '.$res['number_of_episodes'].'</p>';
        echo("<br>");

        echo'<p> Pays d\'origine : '.$res['origin_country'][0].'</p>';
        echo("<br>");

        echo'<p> Nom d\'origine : '.$res['original_name'].'</p>';
        echo("<br>");

        echo'Produit par : ';
        foreach($res['production_companies'] as $companie) {
            echo($companie['name']);
            echo(" ");
        }
        echo("<br>");

        echo'<p> Type : '.$res['type'].'</p>';

        foreach($res['seasons'] as $saison) {
            $posterPath = "https://image.tmdb.org/t/p/w92/" . $res['poster_path'];
            echo("<img src=\"".$posterPath."\"/> ");
            echo($saison['season_number']." ");
            echo($saison['name']." ");
            echo($saison['episode_count']." ");    
        }

        echo "</div>";$res = $this->model->getShowDetails();

        echo '<div class="show-box">';
        echo '<div class="show-main-info">';

        $fullBackdropPath = "https://image.tmdb.org/t/p/original/" . $res['backdrop_path'];
        echo '<div class="backdrop" style="background: url(\'' . $fullBackdropPath . '\'); background-size: cover;"></div>';

        $fullPosterPath = "https://image.tmdb.org/t/p/w500/" . $res['poster_path'];
        echo '<div class="poster">
            <img src="' . $fullPosterPath . '"/>
        </div>';

        $firstAirYear = ' (' . strtok($res['first_air_date'], '-') . ')';

        echo '<div class="main-info-right">';
        echo '<h1 class="show-title">' . $res['name'] . '<span class="show-release-date">' . $firstAirYear . '</span>'. '</h1>';

        $genres = '';
        foreach($res['genres'] as $genre) {
            $genres .= ($genre['name'] . ', ');
        }

        echo rtrim($genres, ', ') . ' - ' . '[durée moyenne à récupérer]';

        echo '<br>';
        echo '<br>';
        echo($res['overview']);

        echo '</div>';

        echo '</div>';

        echo($res['tagline']);

        echo("<br>");

        if($res['in_production']) {
            echo("En cours");
            echo("<br>");
        } else {
            echo("Terminé");
            echo("<br>");
        }

        echo'<p> Dernière diffusion : '.$res['last_air_date'].'</p>' ;
        
        //A revoir

        if($res['in_production'] && $res['next_episode_to_air'] != null) {
           
            echo'<p> Prochain épisode : '.$res['next_episode_to_air']['air_date'].'</p>' ;
            
        } else {
            echo("<br>");
        }

        echo($res['overview']);
        echo("<br>");
        echo("<br>");

        echo'<p> Nombre de saisons : '.$res['number_of_seasons'].'</p>';
        echo'<p> Nombre d\'épisodes : '.$res['number_of_episodes'].'</p>';
        echo("<br>");

        echo'<p> Pays d\'origine : '.$res['origin_country'][0].'</p>';
        echo("<br>");

        echo'<p> Nom d\'origine : '.$res['original_name'].'</p>';
        echo("<br>");

        echo'Produit par : ';
        foreach($res['production_companies'] as $companie) {
            echo($companie['name']);
            echo(" ");
        }
        echo("<br>");

        echo'<p> Type : '.$res['type'].'</p>';

        foreach($res['seasons'] as $saison) {
            $posterPath = "https://image.tmdb.org/t/p/w92/" . $res['poster_path'];
            echo("<img src=\"".$posterPath."\"/> ");
            echo($saison['season_number']." ");
            echo($saison['name']." ");
            echo($saison['episode_count']." ");    
        }

        echo "</div>";

        */
    }
}
