<?php

require_once("GenericView.php");
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

        // Style barre de navigation transparente
        echo '<style>
            header {
                position: absolute;
                top: 3px;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 10000;
                height: 5%;
            }
        </style>';

        $details = $this->model->getDetails();
        $showRating = $this->model->getContentRating();
        $showTrailer = $this->model->getVideos();
        $watchProviders = $this->model->getWatchProviders();
        $externalIds = $this->model->getExternalIds();
        $showCast = $this->model->getCast();

        // Version courte recupération données cast
        $showCastString = '';
        foreach($showCast['cast'] as $index => $value) {
            if (!empty($value['profile_path'])) {
                $profilPath = 'https://image.tmdb.org/t/p/w200' . $value['profile_path'];
            }
            else {
                $profilPath = './Assets/images/image_unavailable200.png';
            }

            $showCastString .= '<li class="item-' . $index . '">
            <div class="cast-box">
                <a href="#"><img src="' . $profilPath . '"></a>
                <h1 class="cast-title">' . $value['name'] . '</h1>
                <h2 class="cast-character">' . $value['character'] . '</h2>
            </div>
        </li>';
        }

        if (!empty($showTrailer['results'])) {
            foreach($showTrailer['results'] as $index => $value) {
                if ($index == 0) {
                    $trailer = $value['key'];
                }
            }
        }
        else {
            $trailer = '';
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

        if (isset($details['networks'])) {
            $networks = array();
            foreach ($details['networks'] as $network) {
                array_push($networks, $network['logo_path']);
            }
            
            $networksString = '';
            foreach ($networks as $network) {
                $networksString .= '<img src="https://image.tmdb.org/t/p/w154' . $network . '"></img><br /><br />';
            }
        }
        else {
            $networksString = "Information indisponible.";
        }

        // header
        $fullBackdropPath = "https://image.tmdb.org/t/p/original" . $details['backdrop_path'];
        $fullPosterPath = "https://image.tmdb.org/t/p/w500" . $details['poster_path'];
        $showName = $details['name'];
        $showFirstAirYear = ' (' . strtok($details['first_air_date'], '-') . ')';
        if (!empty($details['episode_run_time'][0])) {
            $episodeRunTime = $details['episode_run_time'][0] . 'm';
        } else {
            $episodeRunTime = 'Durée moyenne non définie';
        }
        
        $showGenres = rtrim($loopGenres, ', ') . ' - ' . $episodeRunTime;
        $showSynopsis = str_replace('...', '.', $details['overview']);
        $showSynopsisB = str_replace('.', '.<br />', $showSynopsis);
        $tagLine = $details['tagline'];

        // body
        $showWebsite = $details['homepage'];
        $originalName = $details['original_name'];
        $status = $details['status'];
        $type = $details['type'];
        $originalLanguage = $details['original_language'];

        $seasonCount = count($details['seasons'])-1;
        $lastSeasonName = $details['seasons'][$seasonCount]['name'];
        $lastSeasonPosterPath = $details['seasons'][$seasonCount]['poster_path'];
        $lastSeasonEpisodeCount = $details['seasons'][$seasonCount]['episode_count'];
        $lastSeasonNumber = $details['seasons'][$seasonCount]['season_number'];
        $lastSeasonOverview = $details['seasons'][$seasonCount]['overview'];
        $lastSeasonAirDate = $details['seasons'][$seasonCount]['air_date'];


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
                <h1 class="show-title"><a style="color: white" href="#">' . $showName . '</a><span class="show-release-date">' . $showFirstAirYear . '</span>'. '</h1>
                <span class="show-rating">' . $rating . '</span><span class="show-genres">' . $showGenres . '</span>
                <div class="showMainControls">
                    <button class="showTrailerButton"><i class="fa-solid fa-play"></i>  Bande-annonce</button>
                    <div class="modalTrailer-bg" data-value="' . $trailer . '"></div>
                    <div class="showSubControls">';
                    if(isset($_SESSION['login'])){
                        echo '<a href="#"><button class="favButton" id="favButton"><i class="fa-solid fa-heart"></i></button></a>';
                    }
        echo' </div>
                </div>
                <h2 class="show-tagline">' . $tagLine . '</h2>
                <h3 class="section-title">Synopsis</h3>
                <p class="show-synopsis">' .  $showSynopsisB . '</p>
                <h3 class="section-title">Où regarder ?</h3>
                <div class="show-availability">'. $providersString . '</div>
            </div>';

        echo '</div>';
        
        echo '</div>';

        // Display more infos
        echo '<div class="body-show-container">
        
            <div class="showFactsLeftColumn">
                <a target="_blank" href="'. $showWebsite . '"><h4 class="fact-title ta-center"><i class="fa-solid fa-link"></i> Accéder au site officiel</h4></a>

                <h4 class="fact-title">Faits principaux</h4>
                <div class="fact-wrap">
                    <h4 class="fact-subtitle">Nom d\'origine</h4>
                    <h4 class="fact">' . $originalName . '</h4>
                </div>

                <div class="fact-wrap">
                    <h4 class="fact-subtitle">Statut</h4>
                    <h4 class="fact">' . $status . '</h4>
                </div>

                <div class="fact-wrap">
                    <h4 class="fact-subtitle">Diffuseurs télévisés</h4>
                    <h4 class="fact">' . $networksString . '</h4>
                </div>

                <div class="fact-wrap">
                    <h4 class="fact-subtitle">Type</h4>
                    <h4 class="fact">' . $type . '</h4>
                </div>

                <div class="fact-wrap">
                    <h4 class="fact-subtitle">Langue d\'origine</h4>
                    <h4 class="fact">' . $originalLanguage . '</h4>
                </div>
            </div>

            <div class="showPanel">
                    <h2 class="panel-title">Distribution des rôles</h2>

                    <ul id="autoWidthShowCast" class="cs-hidden">
                        ' .$showCastString . '
                    </ul>

                <div class="panel-box">
                <h2 class="panel-title mb-20">Dernière saison</h2>

                <div class="panel-showLastSeason">
                    <img src="https://image.tmdb.org/t/p/w500'. $lastSeasonPosterPath .'"></img>
                    <div class="panel-lastSeasonDetails">
                        <h1 class="panel-lastSeasonTitle">'. $lastSeasonName .'</h1>
                        <h2 class="panel-lastSeasonInfos">'. $lastSeasonAirDate .' | '. $lastSeasonEpisodeCount .' épisode(s)</h2>
                        <p>'. $lastSeasonOverview .'</p>
                    </div>
                </div>
                </div>
            </div>

        </div>';
    }
}
