<?php

require_once('PDOConnection.php');
require_once('Alert.php');

class ModelLists extends PDOConnection
{

    private $viewAlert;

    public function __construct()
    {
        $this->viewAlert = new Alert;
    }

    public function callTmdbAPI($api_url) {
        $ch = curl_init();
        try {

            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo curl_error($ch);
                die();
            }

            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($http_code == intval(200)) {
                $res = json_decode($response, true);
                return $res;
            } else {
                echo "Ressource introuvable : " . $http_code;
            }
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            curl_close($ch);
        }
    }

    public function getDetails($idShow) {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/tv/".$idShow."?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR&region=FR&page=1");
    }

    public function getFollowedShows() {
        $sql = 'SELECT * FROM FollowedShows WHERE idUser = :idUser';
        $followedShows=parent::$db->prepare($sql);
        $followedShows->execute(array(':idUser'=>$_SESSION['id']));

        $tab = $followedShows->fetchAll();
        return $tab;
    }

    public function getToWatchLaterShows() {
        $sql = 'SELECT * FROM ToWatchLaterShows WHERE idUser = :idUser';
        $toWatchLaterShows=parent::$db->prepare($sql);
        $toWatchLaterShows->execute(array(':idUser'=>$_SESSION['id']));

        $tab = $toWatchLaterShows->fetchAll();
        return $tab;
    }

    public function getIdGenres() {
        $sql = 'SELECT idGenre FROM Genre';
        $genres=parent::$db->prepare($sql);
        $genres->execute();

        $tab = $genres->fetchAll();
        return $tab;
    }

   public function getRecommendations() {
        $sql = 'SELECT idGenre,COUNT(idGenre) FROM FollowedShows JOIN Belong USING(idShow) JOIN Genre USING(idGenre) WHERE idUser = :idUser GROUP BY idGenre ORDER BY COUNT(idGenre) DESC';
        $favGenres=parent::$db->prepare($sql);
        $favGenres->execute(array(':idUser'=>$_SESSION['id']));

        $tab = $favGenres->fetchAll();

        $favGenresString = '';

        if(isset($tab[2])) {
            $favGenresString = $tab[0][0] . ',' . $tab[1][0] . ',' . $tab[2][0];
        } else if (isset($tab[1])) {
            $favGenresString = $tab[0][0] . ',' . $tab[1][0];
        } else if (isset($tab[0])) {
            $favGenresString = $tab[0][0];
        } else {
            return null;
        }

        $recoUnfiltered = $this->callTmdbAPI("https://api.themoviedb.org/3/discover/tv?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR&sort_by=popularity.desc&page=1&watch_region=FR&with_genres=".$favGenresString);

        $followedShows = $this->getFollowedShows();

        $recoFiltered = array();

        foreach ($recoUnfiltered['results'] as $show) {
            $alreadyFollowed = false;
            foreach ($followedShows as $followedShow) {
                if ($show['id'] == $followedShow['idShow']) {
                    $alreadyFollowed = true;
                }
            }
            if(!$alreadyFollowed) {
                array_push($recoFiltered, $show);
            }
        }

        $toWatchLaterShows = $this->getToWatchLaterShows();

        $recommendations = array();

        foreach ($recoFiltered as $show) {
            $alreadyToWatchLater = false;
            foreach ($toWatchLaterShows as $toWatchLaterShow) {
                if ($show['id'] == $toWatchLaterShow['idShow']) {
                    $alreadyToWatchLater = true;
                }
            }
            if(!$alreadyToWatchLater) {
                array_push($recommendations, $show);
            }
        }

        return $recommendations;

   }

   /*Reco pour une série précise
   https://api.themoviedb.org/3/tv/$idShow/recommendations?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR&page=1

   Similaire 
   https://api.themoviedb.org/3/tv/$idShow/similar?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR&page=1
   */

}