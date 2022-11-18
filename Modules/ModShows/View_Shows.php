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

    public function show_show()
    {
        $res = $this->model->getShowDetails();

        echo '<div class="show-box">';
        echo '<div class="show-images">';

        $fullBackdropPath = "https://image.tmdb.org/t/p/original/" . $res['backdrop_path'];
        echo '<div class="backdrop" style="background: url(\'' . $fullBackdropPath . '\');"></div>';

        $fullPosterPath = "https://image.tmdb.org/t/p/w500/" . $res['poster_path'];
        echo '<div class="poster">
            <img src="' . $fullPosterPath . '"/>
        </div>';

        echo '</div>';

        echo '<div class="show-info">';

        echo '<div class="show-info-left">';
        echo '</div>';
        
        echo '<div class="show-info-right">';
        echo'<h3 style="font-weight: bold; color: white;">'.$res['name'].'</h3>';
        echo("<br>");
        echo($res['tagline']);
        echo("<br>");


        echo("Genre(s) : ");
        foreach($res['genres'] as $genre) {
            
            echo($genre['name']);
            echo(", ");
        }
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

        echo '</div>';

        echo '</div>';

        echo "</div>";

    }
}
