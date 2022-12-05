<?php

require_once('Model_Shows.php');
require_once('View_Shows.php');

class ContShows
{
    private $view;
    private $model;
    private $action;

    public function __construct() 
    {
        $this->view = new ViewShows();
        $this->model = new ModelShows();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "show";
    }

    public function getAction() {
        return $this->action;
    }

    public function overview() {

        $details = $this->model->getDetails();
        $showLogo = $this->model->getImagesFR();
        $showRating = $this->model->getContentRating();
        $showVideos = $this->model->getVideos();
        $watchProviders = $this->model->getWatchProviders();
        $showCast = $this->model->getCast();
        $showImages = $this->model->getImages();
        $showVideos = $this->model->getVideos();
        $recommandations = $this->model->getRecommandations();

        $this->view->show_overview(
            $this->model->checkFollowStatus(), 
            $this->model->checkSaveStatus(),
            $this->model->getBackdropPath($details),
            $this->model->getPosterPath($details),
            $details['name'],
            $this->model->getShowLogo($showLogo),
            $this->model->getShowFirstAirYear($details),
            $this->model->getEpisodeRuntime($details),
            $this->model->getRating($showRating),
            $this->model->getShowGenres($details, $this->model->getEpisodeRuntime($details)),
            $this->model->getTrailer($showVideos),
            $details['tagline'],
            $this->model->getShowSynopsis($details),
            $this->model->getShowWatchProviders($watchProviders),
            $details['homepage'],
            $details['original_name'],
            $details['status'],
            $details['type'],
            $details['original_language'],
            $this->model->getShowNetworks($details),
            $this->model->getShowCast($showCast),
            $this->model->getNextEpisodeInfos($details, 'air_date'),
            $this->model->getNextEpisodeInfos($details, 'episode_number'),
            $this->model->getNextEpisodeInfos($details, 'name'),
            $this->model->getNextEpisodeInfos($details, 'overview'),
            $this->model->getNextEpisodeInfos($details, 'season_number'),
            $this->model->getNextEpisodeInfos($details, 'still_path'),
            $this->model->getLastEpisodeInfos($details, 'still_path'),
            $this->model->getLastEpisodeInfos($details, 'name'),
            $this->model->getLastEpisodeInfos($details, 'season_number'),
            $this->model->getLastEpisodeInfos($details, 'episode_number'),
            $this->model->getLastEpisodeInfos($details, 'air_date'),
            $this->model->getLastEpisodeInfos($details, 'overview'),
            $this->model->getLastSeasonInfos($details, 'poster_path'),
            $this->model->getLastSeasonInfos($details, 'name'),
            $this->model->getLastSeasonInfos($details, 'air_year'),
            $this->model->getLastSeasonInfos($details, 'episode_count'),
            $this->model->getLastSeasonInfos($details, 'overview'),
            $this->model->getShowFirstWallpapers($showImages),
            $this->model->getShowFirstVideos($showVideos),
            $this->model->getShowFirstPosters($showImages),
            count($showVideos['results']),
            count($showImages['backdrops']),
            count($showImages['posters']),
            $this->model->getRecommandationsString($recommandations));
    }

   
    public function deleteCom(){
        $this->model->deleteComments();
    }

    public function exec() {
        $this->view->view();
    }
}

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/