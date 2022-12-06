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

    public function show_overview(
        $isFollowing,
        $isSavedForLater,
        $fullBackdropPath,
        $fullPosterPath,
        $showName,
        $logo,
        $showFirstAirYear,
        $episodeRunTime,
        $rating,
        $showGenres,
        $trailer,
        $tagLine,
        $showSynopsisB,
        $providersString,
        $showWebsite,
        $originalName,
        $status,
        $type,
        $originalLanguage,
        $networksString,
        $showCastString,
        $nextEpisodeToAirDate,
        $nextEpisodeToAirNumber,
        $nextEpisodeToAirName,
        $nextEpisodeToAirOverview,
        $nextEpisodeToAirSeason,
        $nextEpisodeToAirThumbail,
        $lastEpisodeToAirThumbail,
        $lastEpisodeToAirName,
        $lastEpisodeToAirSeason,
        $lastEpisodeToAirNumber,
        $lastEpisodeToAirDate,
        $lastEpisodeToAirOverview,
        $lastSeasonPosterPath,
        $lastSeasonName,
        $lastSeasonAirYear,
        $lastSeasonEpisodeCount,
        $lastSeasonOverview,
        $showWallpapersString,
        $showVideosString,
        $showPostersString,
        $videoCount,
        $imageCount,
        $posterCount,
        $recommandationsString,
        $hasLiked
    ) {

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

        if (!empty($logo)) {
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

        if (isset($_SESSION['login'])) {
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

            if ($hasLiked) {
                echo '<div class="likeShows activeLikeButton" id="likeShows"><i class="fa-solid fa-thumbs-up "></i></div>';
            } else {
                echo '<div class="likeShows" id="likeShows"><i class="fa-solid fa-thumbs-up"></i></div>';
            }

            echo '</div>';

            $countLike = $this->model->getCountShowLikes(htmlspecialchars($_GET['id']));
            foreach ($countLike as $row) {
                echo $row[0];
            }
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

                </div>';

        if (isset($_SESSION['login'])) {
            echo '<div class="panel-box">
                    <h2 class="panel-title mb-20">Commentaires</h2>';

            $comments = $this->model->getComments();
            foreach ($comments as $row) {
                $idCom = htmlspecialchars($row['idCom']);
                $idUser = htmlspecialchars($row['id']);
                $userName = htmlspecialchars($row['username']);
                $idRole = htmlspecialchars($row['idRole']);

                if ($userName == $_SESSION['login']) {
                    echo "<b>" . $userName . "</b>" . " : " . $row['message'] . "<br>";
                } else {
                    echo '<a href="./?module=profile&action=view&id=' . $idUser . '"> ' . $userName . ' </a>' . " : " . $row['message'] . "<br>";
                }
                echo 'Publié le : ' . $row['datePublication'] . "<br>";

                if ($_SESSION['idRole'] == 1) {
                    echo '<b> <a class="deleteComments" href="./?module=shows&action=deleteComments&id=' . htmlspecialchars($_GET['id']) . '&idCom=' . $idCom . '&idUser=' . $idUser . '"> Supprimer </a> </b>';
                } else {
                    if ($_SESSION['idRole'] == $idRole && $userName == $_SESSION['login']) {
                        echo '<b> <a class="deleteComments" href="./?module=shows&action=deleteComments&id=' . htmlspecialchars($_GET['id']) . '&idCom=' . $idCom . '&idUser=' . $idUser . '"> Supprimer </a> </b>';
                    }
                }
                echo '<br> <br>';
            }


            if (isset($_SESSION['login'])) {
                echo '
                    <form method="POST">
                        <input class="form-input zoneComments" type="text" name="commentaire" placeholder="Ajouter un commentaire..." required>
                        <div class="submitCommentButton">
                            <button targetID="resultCommentsAJAX" class="addComment btngradient btngradient-hover color-9">Poster</button>
                        </div>
                    </form>';
            }

            echo '</div>';
        }

        echo '

                <div class="panel-box">
                    <h2 class="panel-title">Ça pourrait t\'intéresser...</h2>

                    <ul id="autoWidthShowSimilar" class="cs-hidden">
                        ' . $recommandationsString . '
                    </ul>
                </div>
            </div>

        </div>';
    }
}

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/