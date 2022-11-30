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
        
        $isFollowing = $this->model->checkFollowStatus();
        $isSavedForLater = $this->model->checkSaveStatus();

        $details = $this->model->getDetails();
        $showRating = $this->model->getContentRating();
        $showVideos = $this->model->getVideos();
        $watchProviders = $this->model->getWatchProviders();
        $externalIds = $this->model->getExternalIds();
        $showCast = $this->model->getCast();
        $showImages = $this->model->getImages();
        $showLogo = $this->model->getImagesFR();
        $similars = $this->model->getSimilar();

        if (!empty($showLogo['logos'][0]['file_path'])) {
            $logo = $showLogo['logos'][0]['file_path'];
        }

        // Version courte recupération données cast
        $showCastString = '';
        foreach ($showCast['cast'] as $index => $value) {
            if (!empty($value['profile_path'])) {
                $profilPath = 'https://image.tmdb.org/t/p/w200' . $value['profile_path'];
            } else {
                $profilPath = './Assets/images/image_unavailable.png';
            }

            $showCastString .= '<li class="item-' . $index . '">
            <div class="cast-box">
                <a href="#"><img src="' . $profilPath . '"></a>
                <h1 class="cast-title">' . $value['name'] . '</h1>
                <h2 class="cast-character">' . $value['character'] . '</h2>
            </div>
        </li>';
        }

        $similarString = '';
        foreach ($similars['results'] as $index => $value) {
            if (!empty($value['poster_path'])) {
                $similarPosterPath = 'https://image.tmdb.org/t/p/w342' . $value['poster_path'];
            } else {
                $similarPosterPath = './Assets/images/image_unavailable.png';
            }

            $similarString .= '<li class="item-' . $index . '">
            <div class="trending-box">
                <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $similarPosterPath . '"></a>
            </div>
        </li>';
        }

        if (!empty($showVideos['results'])) {
            foreach ($showVideos['results'] as $index => $value) {
                if ($index == 0) {
                    $trailer = $value['key'];
                }
            }
        } else {
            $trailer = '';
        }

        $loopGenres = '';
        foreach ($details['genres'] as $genre) {
            $loopGenres .= ($genre['name'] . ', ');
        }

        if (!empty($showRating['results'])) {
            foreach ($showRating['results'] as $index => $value) {
                if ($index == 0) {
                    $rating = $value['rating'];
                }
            }
        } else {
            $rating = 'N/A';
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
        } else {
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
        } else {
            $networksString = "Information indisponible.";
        }


        $videoCount = count($showVideos['results']);
        $imageCount = count($showImages['backdrops']);
        $posterCount = count($showImages['posters']);

        $showVideosString = '';
        foreach ($showVideos['results'] as $index => $value) {
            $showVideosString .= '<li class="item-' . $index . '">
            <div class="videos-box">
                <a href="#">
                <img src="https://img.youtube.com/vi/' . $value['key'] . '/maxresdefault.jpg">
                </a>
            </div>
        </li>';
        }

        $showWallpapersString = '';
        foreach ($showImages['backdrops'] as $index => $value) {
            if ($index <= 4) {
                $showWallpapersString .= '<li class="item-' . $index . '">
            <div class="videos-box">
                <a href="#">
                <img src="https://image.tmdb.org/t/p/w500' . $value['file_path'] . '"
                </a>
            </div>
        </li>';
            }
        }

        $showPostersString = '';
        foreach ($showImages['posters'] as $index => $value) {
            if ($index <= 4) {
                $showPostersString .= '<img src="https://image.tmdb.org/t/p/w200' . $value['file_path'] . '"></img>';
            }
        }


        // header
        $fullBackdropPath = "https://image.tmdb.org/t/p/original" . $details['backdrop_path'];

        if (!empty($details['poster_path'])) {
            $fullPosterPath = "https://image.tmdb.org/t/p/w500" . $details['poster_path'];
        } else {
            $fullPosterPath = 'Assets/images/image_unavailable.png';
        }

        $showName = $details['name'];
        $showFirstAirYear = ' (' . strtok($details['first_air_date'], '-') . ')';
        if (!empty($details['episode_run_time'][0])) {
            $episodeRunTime = ' - ' . $details['episode_run_time'][0] . 'm';
        } else {
            $episodeRunTime = '';
        }

        $showGenres = rtrim($loopGenres, ', ') . $episodeRunTime;
        $showSynopsis = str_replace('...', '.', $details['overview']);
        $showSynopsisB = str_replace('.', '.<br />', $showSynopsis);
        $tagLine = $details['tagline'];

        // body
        $showWebsite = $details['homepage'];
        $originalName = $details['original_name'];
        $status = $details['status'];
        $type = $details['type'];
        $originalLanguage = $details['original_language'];

        $seasonCount = count($details['seasons']) - 1;
        $lastSeasonName = $details['seasons'][$seasonCount]['name'];

        if (!empty($details['seasons'][$seasonCount]['poster_path'])) {
            $lastSeasonPosterPath = $details['seasons'][$seasonCount]['poster_path'];
        } else {
            $lastSeasonPosterPath = $details['poster_path'];
        }


        $lastSeasonEpisodeCount = $details['seasons'][$seasonCount]['episode_count'];
        $lastSeasonNumber = $details['seasons'][$seasonCount]['season_number'];
        $lastSeasonOverview = $details['seasons'][$seasonCount]['overview'];
        $lastSeasonAirDate = $details['seasons'][$seasonCount]['air_date'];
        $lastSeasonAirDateTime = new DateTime($details['seasons'][$seasonCount]['air_date']);
        $lastSeasonAirYear = $lastSeasonAirDateTime->format('Y');

        $lastEpisodeToAirNumber = $details['last_episode_to_air']['episode_number'];
        $lastEpisodeToAirName = $details['last_episode_to_air']['name'];
        $lastEpisodeToAirOverview = $details['last_episode_to_air']['overview'];
        $lastEpisodeToAirSeason = $details['last_episode_to_air']['season_number'];

        if (!empty($details['last_episode_to_air']['still_path'])) {
            $lastEpisodeToAirThumbail = 'https://image.tmdb.org/t/p/w500' . $details['last_episode_to_air']['still_path'];
        } else {
            $lastEpisodeToAirThumbail = "Assets/images/episode_thumbail_unavailable.png";
        }


        $lastEpisodeToAirDate = (new DateTime($details['last_episode_to_air']['air_date']))->format('d M Y');

        $nextEpisodeToAirNumber = '';
        $nextEpisodeToAirName = '';
        $nextEpisodeToAirOverview = '';
        $nextEpisodeToAirSeason = '';
        $nextEpisodeToAirThumbail = '';
        $nextEpisodeToAirDate = '';

        if (!empty($details['next_episode_to_air']['air_date'])) {
            $nextEpisodeToAirNumber = $details['next_episode_to_air']['episode_number'];
            $nextEpisodeToAirName = $details['next_episode_to_air']['name'];
            $nextEpisodeToAirOverview = $details['next_episode_to_air']['overview'];
            $nextEpisodeToAirSeason = $details['next_episode_to_air']['season_number'];
            if (!empty($details['next_episode_to_air']['still_path'])) {
                $nextEpisodeToAirThumbail = 'https://image.tmdb.org/t/p/w500' . $details['next_episode_to_air']['still_path'];
            } else {
                $nextEpisodeToAirThumbail = "Assets/images/episode_thumbail_unavailable.png";
            }
            $nextEpisodeToAirDate = (new DateTime($details['next_episode_to_air']['air_date']))->format('d M Y');
        }


        echo '<div class="show-box">';

        echo '<div class="header-show-container">';

        // Display backdrop
        echo '<div class="backdrop" style="background: url(\'' . $fullBackdropPath . '\'); background-size: cover;"></div>';

        // Display poster and infos
        echo '<div class="showPosterAndMainInfo">
            <div class="poster">
                <img src="' . $fullPosterPath . '"/>
            </div>
            <div class="showMainInfo">';

        if (!empty($showLogo['logos'][0]['file_path']) && $showLogo['logos'][0]['height'] < 700) {
            echo '<h1 class="show-title"><img style="margin-bottom: 20px; width: 25%; margin-top: -30px" src="https://image.tmdb.org/t/p/w500' . $logo . '"></img>' . '</h1>';
        } else {
            echo '<h1 class="show-title"><a style="color: white" href="#">' . $showName . '</a><span class="show-release-date">' . $showFirstAirYear . '</span>' . '</h1>';
        }

        echo '
                <span class="show-rating">' . $rating . '</span><span class="show-genres">' . $showGenres . '</span>
                <div class="showMainControls">
                    <div class="show-actions">
                        <button class="showTrailerButton"><i class="fa-solid fa-play"></i>  Bande-annonce</button>
                    <div class="modalTrailer-bg" data-value="' . $trailer . '"></div>';

                    if(isset($_SESSION['login'])){
                        echo ' <div class="showSubControls">';

                        if ($isFollowing) {
                            echo '<div class="favButton activeFavButton" id="favButton"><i class="fa-solid fa-heart"></i></div>';
                        } else {
                            echo '<div class="favButton" id="favButton"><i class="fa-solid fa-heart"></i></div>';
                        }

                        if ($isSavedForLater) {
                            echo '<div class="saveButton activeSaveButton" id="saveButton"><i class="fa-solid fa-bookmark"></i></div>';
                        } else {
                            echo '<div class="saveButton" id="saveButton"><i class="fa-solid fa-bookmark"></i></div>';
                        }

                        echo '</div>';
                    }
                    
        echo ' 
        </div>
                </div>
                <h2 class="show-tagline">' . $tagLine . '</h2>
                <h3 class="section-title">Synopsis</h3>
                <p class="show-synopsis">' .  $showSynopsisB . '</p>
                <h3 class="section-title">Où regarder ?</h3>
                <div class="show-availability">' . $providersString . '</div>
            </div>';

        echo '</div>';

        echo '</div>';

        // Display more infos
        echo '<div class="body-show-container">
        
            <div class="showFactsLeftColumn">
                <a target="_blank" href="' . $showWebsite . '"><h4 class="fact-title ta-center"><i class="fa-solid fa-link"></i> Accéder au site officiel</h4></a>

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
                <div class="first-panel-box">
                    <h2 class="panel-title">Distribution des rôles</h2>

                    <ul id="autoWidthShowCast" class="cs-hidden">
                        ' . $showCastString . '
                    </ul>
                </div>

                <div class="panel-box">
                    <h2 class="panel-title mb-25">Épisode <span class="selector activeSpan" id="panelLastEpisodeButton">Dernier</span>';

        if (!empty($nextEpisodeToAirDate)) {
            echo  '<span class="selector" id="panelNextEpisodeButton">Prochain</span>';
        }

        echo '</h2>
                    <div class="panel-showLastEpisode">
                        <img src="' . $lastEpisodeToAirThumbail . '"></img>
                        <div class="panel-lastSeasonDetails">
                            <h1 class="panel-lastSeasonTitle">' . $lastEpisodeToAirName . '</h1>
                            <h2 class="panel-lastSeasonInfos">Saison ' . $lastEpisodeToAirSeason . ', Épisode ' . $lastEpisodeToAirNumber . ' | Sortie le : ' . $lastEpisodeToAirDate . '</h2>
                            <p>' . $lastEpisodeToAirOverview . '</p>
                        </div>
                    </div>

                    <div class="panel-showNextEpisode hidden">
                        <img src="' . $nextEpisodeToAirThumbail . '"></img>
                        <div class="panel-lastSeasonDetails">
                            <h1 class="panel-lastSeasonTitle">' . $nextEpisodeToAirName . '</h1>
                            <h2 class="panel-lastSeasonInfos">Saison ' . $nextEpisodeToAirSeason . ', Épisode ' . $nextEpisodeToAirNumber . ' | Sortie le : ' . $nextEpisodeToAirDate . '</h2>
                            <p>' . $nextEpisodeToAirOverview . '</p>
                        </div>
                    </div>
                </div>

                <div class="panel-box">
                <h2 class="panel-title mb-20">Dernière saison</h2>

                <div class="panel-showLastSeason">
                    <img src="https://image.tmdb.org/t/p/w500' . $lastSeasonPosterPath . '"></img>
                    <div class="panel-lastSeasonDetails">
                        <h1 class="panel-lastSeasonTitle">' . $lastSeasonName . '</h1>
                        <h2 class="panel-lastSeasonInfos">' . $lastSeasonAirYear . ' | ' . $lastSeasonEpisodeCount . ' épisodes</h2>
                        <p>' . $lastSeasonOverview . '</p>
                    </div>
                </div>
                </div>

                <div class="panel-box">
                    <h2 class="panel-title mb-20">Médias <span class="activeSpan selector" id="panelWallpapersButton">Images <span class="countElements">' . $imageCount . '</span></span> <span class="selector" id="panelVideosButton">Vidéos <span class="countElements">' . $videoCount . '</span></span> <span class="selector" id="panelPostersButton">Affiches <span class="countElements">' . $posterCount . '</span></span></h2>

                    <div class="showWallpapers">
                    <ul id="autoWidthShowWallpapers" class="cs-hidden">
                        ' . $showWallpapersString . '
                    </ul>
                    </div>

                    <ul id="autoWidthShowVideos" class="cs-hidden hidden">
                    ' . $showVideosString . '
                    </ul>

                    <div id="showPosters" class="showPosters hidden">
                        ' . $showPostersString . '
                    </div>

                </div>

                <div class="panel-box">
                    <h2 class="panel-title">Ça pourrait t\'intéresser...</h2>

                    <ul id="autoWidthShowSimilar" class="cs-hidden">
                        ' . $similarString . '
                    </ul>
                </div>
            </div>

        </div>

        <br> <br> <br>';
        

        if(isset($_SESSION['login'])){
            $idShow = $_GET['id'];
            echo '
                <div class="forComments">
                    <h1 class="titleComments"> Commentaires : </h1> <br>
                    <form action="./?module=shows&action=sendComments&id='.$idShow.'" method="POST">
                            <textarea class="zoneComments "name="commentaire" placeholder="Votre commentaire ..."> </textarea> <br><br>
            
                            <input type="submit" id="submitComments" value="Poster mon commentaire">   
                    </form> 
                </div>
            ';
            
            echo "<br> <br>";

            $comments = $this->model->getComments();
            foreach($comments as $row){
                $idCom = $row['idCom'];
                $idUser = $row['id'];
                $userName = $row['username'];
                $idRole = $row['idRole'];
                
                if($userName == $_SESSION['login']){
                    echo '<b class="usernameComments">'. $userName . '</b>' . " : " . $row['message'] . "<br>";
                }
                else {
                    echo '<b>' . '<a href="./?module=profile&action=viewOtherProfile&id='.$idUser.'"> '.$userName.' </a>' . '</b>' . " : " . $row['message'] . "<br>";
                }

                echo 'Publié le : ' . $row['datePublication'] . "<br>";

                if($_SESSION['idRole'] == 1){
                        echo'<b> <a class="deleteComments" href="./?module=shows&action=deleteComments&idCom='.$idCom.'&idUser='.$idUser.'&idShow='.$_GET['id'].'"> Supprimer </a> </b>';
                }
                else {
                    if($_SESSION['idRole'] == $idRole && $userName == $_SESSION['login']){
                        echo'<b> <a class="deleteComments" href="./?module=shows&action=deleteComments&idCom='.$idCom.'&idUser='.$idUser.'&idShow='.$_GET['id'].'"> Supprimer </a> </b>';
                    }
                }
                echo '<br> <br>';  
            }
        }
    }

    public function redirection(){
        $idShow = $_GET['id'];
        $urlShow = "./?module=shows&action=overview&id=$idShow";
        header("refresh:0, url=$urlShow");
    }

}
