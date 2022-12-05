<?php

require_once('PDOConnection.php');
require_once('Alert.php');

class ModelShows extends PDOConnection
{

    private $viewAlert;

    public function __construct()
    {
        $this->viewAlert = new Alert;
        $this->addShowToDB();
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

    public function hasLiked() {
        if (isset($_SESSION['login'])) {

            $idShow = $_GET['id'];
            $idUser = $_SESSION['id'];

            try{
                $stmt = parent::$db->prepare("SELECT COUNT(*) FROM ListLikes WHERE idUser=:idUser AND idShow=:idShow");
                $stmt->bindParam(':idUser', $idUser);
                $stmt->bindParam(':idShow', $idShow);
                $stmt->execute();
                $hasLiked = $stmt->fetchAll();
                if ($hasLiked[0][0] == 1) {
                    return true;
                } else {
                    return false;
                }
            }
            catch (Exception $e) {
                echo 'Erreur survenue : ',  $e->getMessage(), "\n";
            }
        }
    }

    public function checkFollowStatus() {
        if (isset($_SESSION['login'])) {

            $idShow = $_GET['id'];
            $idUser = $_SESSION['id'];

            try{
                $stmt = parent::$db->prepare("SELECT COUNT(*) FROM FollowedShows WHERE idUser=:idUser AND idShow=:idShow");
                $stmt->bindParam(':idUser', $idUser);
                $stmt->bindParam(':idShow', $idShow);
                $stmt->execute();
                $isFollowing = $stmt->fetchAll();
                if ($isFollowing[0][0] == 1) {
                    return true;
                } else {
                    return false;
                }
            }
            catch (Exception $e) {
                echo 'Erreur survenue : ',  $e->getMessage(), "\n";
            }
        }
    }

    public function checkSaveStatus() {
        if (isset($_SESSION['login'])) {

            $idShow = $_GET['id'];
            $idUser = $_SESSION['id'];

            try{
                $stmt = parent::$db->prepare("SELECT COUNT(*) FROM ToWatchLaterShows WHERE idUser=:idUser AND idShow=:idShow");
                $stmt->bindParam(':idUser', $idUser);
                $stmt->bindParam(':idShow', $idShow);
                $stmt->execute();
                $isSaved = $stmt->fetchAll();
                if ($isSaved[0][0] == 1) {
                    return true;
                } else {
                    return false;
                }
            }
            catch (Exception $e) {
                echo 'Erreur survenue : ',  $e->getMessage(), "\n";
            }
        }
    }


    public function getCountShowLikes($idShow){
        try {
            $requestCountLike = parent::$db->prepare("SELECT COUNT(*) FROM ListLikes WHERE idShow = ?");
            $requestCountLike->execute(array($idShow));
            return $requestCountLike->fetchAll();
        }
        catch (Exception $e) {
                echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }

    public function deleteComments(){
        $idCom = $_GET['idCom'];
        $idUser = $_GET['idUser'];
        $idRole = $_SESSION['idRole'];

        if($idUser == $_SESSION['id'] || $idRole == 1){
            try {
                $requestdeleteComments = parent::$db->prepare("DELETE FROM Comment WHERE idCom = ?");
                $requestdeleteComments->execute(array($idCom));
                header("Location:./?module=shows&action=overview&id=".$_GET['id']);
            }
            catch (Exception $e) {
                echo 'Erreur survenue : ',  $e->getMessage(), "\n";
            }
        }
    }


    public function getComments(){
        $idShow = $_GET['id'];
        try {
            $requesteGetComments = parent::$db->prepare("SELECT idCom, username, message, id, datePublication, idRole FROM User NATURAL JOIN Comment WHERE idShow = ? ORDER BY idCom DESC");
            $requesteGetComments->execute(array($idShow));

            return $requesteGetComments->fetchAll();
        }
        catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }


    public function getBackdropPath($details) {
        $fullBackdropPath = "https://image.tmdb.org/t/p/original" . $details['backdrop_path'];
        
        return $fullBackdropPath;
    }

    public function getPosterPath($details) {
        if (!empty($details['poster_path'])) {
            $fullPosterPath = "https://image.tmdb.org/t/p/w500" . $details['poster_path'];
        } else {
            $fullPosterPath = 'Assets/images/image_unavailable.png';
        }

        return $fullPosterPath;
    }

    public function getShowLogo($showLogo) {
        if (!empty($showLogo['logos'][0]['file_path']) && $showLogo['logos'][0]['height'] < 700) {
            $logo = $showLogo['logos'][0]['file_path'];
        }
        else {
            $logo = '';
        }

        return $logo;
    }

    public function getShowFirstAirYear($details) {
        $showFirstAirYear = ' (' . strtok($details['first_air_date'], '-') . ')';
        
        return $showFirstAirYear;
    }

    public function getEpisodeRuntime($details) {
        if (!empty($details['episode_run_time'][0])) {
            $episodeRunTime = ' - ' . $details['episode_run_time'][0] . 'm';
        } else {
            $episodeRunTime = '';
        }

        return $episodeRunTime;
    }

    public function getRating($showRating) {
        if (!empty($showRating['results'])) {
            foreach ($showRating['results'] as $index => $value) {
                if ($index == 0) {
                    $rating = $value['rating'];
                }
            }
        } else {
            $rating = 'N/A';
        }
        
        return $rating;
    }

    public function getShowGenres($details, $episodeRunTime) {
        $loopGenres = '';

        foreach ($details['genres'] as $genre) {
            $loopGenres .= ($genre['name'] . ', ');
        }

        $showGenres = rtrim($loopGenres, ', ') . $episodeRunTime;

        return $showGenres;
    }

    public function getTrailer($showVideos) {
        if (!empty($showVideos['results'])) {
            foreach ($showVideos['results'] as $index => $value) {
                if ($index == 0) {
                    $trailer = $value['key'];
                }
            }
        } else {
            $trailer = '';
        }

        return $trailer;
    }

    public function getShowSynopsis($details) {
        $showSynopsis = str_replace('...', '.', $details['overview']);
        $showSynopsisB = str_replace('.', '.<br />', $showSynopsis);

        return $showSynopsisB;
    }

    public function getShowWatchProviders($watchProviders) {
        if (isset($watchProviders['results']['FR'])) {
            $providers = array();
            
            if(isset($watchProviders['results']['FR']['flatrate'])) {
                foreach ($watchProviders['results']['FR']['flatrate'] as $provider) {
                    array_push($providers, $provider['logo_path']);
                }    
            }
            
            $providersString = '';
            foreach ($providers as $provider) {
                $providersString .= '<img src="https://image.tmdb.org/t/p/original' . $provider . '"></img>';
            }
        } else {
            $providersString = "Information indisponible.";
        }

        return $providersString;
    }

    public function getShowNetworks($details) {
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

        return $networksString;
    }

    public function getShowCast($showCast) {
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

        return $showCastString;
    }

    public function getLastEpisodeInfos($details, $info) {
        if ($info == 'episode_number') {
            return $details['last_episode_to_air']['episode_number'];
        } 
        else if ($info == 'name') {
            return $details['last_episode_to_air']['name'];
        }
        else if ($info == 'overview') {
            return $details['last_episode_to_air']['overview'];
        }
        else if ($info == 'season_number') {
            return $details['last_episode_to_air']['season_number'];
        } else if ($info == 'still_path') {
            if (!empty($details['last_episode_to_air']['still_path'])) {
                $lastEpisodeToAirThumbail = 'https://image.tmdb.org/t/p/w500' . $details['last_episode_to_air']['still_path'];
            } else {
                $lastEpisodeToAirThumbail = "Assets/images/episode_thumbail_unavailable.png";
            }

            return $lastEpisodeToAirThumbail;
        } else if ($info == 'air_date') {
            return (new DateTime($details['last_episode_to_air']['air_date']))->format('d M Y');
        }
        else {
            return 'N/A';
        }
    }

    public function getNextEpisodeInfos($details, $info) {
        if (!empty($details['next_episode_to_air']['episode_number'])) {
            if ($info == 'episode_number') {
                return $details['next_episode_to_air']['episode_number'];
            } 
            else if ($info == 'name') {
                return $details['next_episode_to_air']['name'];
            }
            else if ($info == 'overview') {
                return $details['next_episode_to_air']['overview'];
            }
            else if ($info == 'season_number') {
                return $details['next_episode_to_air']['season_number'];
            }
            else if ($info == 'still_path') {
                if (!empty($details['next_episode_to_air']['still_path'])) {
                    $nextEpisodeToAirThumbail = 'https://image.tmdb.org/t/p/w500' . $details['next_episode_to_air']['still_path'];
                } else {
                    $nextEpisodeToAirThumbail = "Assets/images/episode_thumbail_unavailable.png";
                }

                return $nextEpisodeToAirThumbail;
            }
            else if ($info == 'air_date') {
                return (new DateTime($details['next_episode_to_air']['air_date']))->format('d M Y');
            }
            else {
                return 'N/A';
            }
        }
    }

    public function getLastSeasonInfos($details, $info) {
        $seasonCount = count($details['seasons']) - 1;

        if ($info == 'poster_path') {
            if (!empty($details['seasons'][$seasonCount]['poster_path'])) {
                $lastSeasonPosterPath = $details['seasons'][$seasonCount]['poster_path'];
            } else {
                $lastSeasonPosterPath = $details['poster_path'];
            }

            return $lastSeasonPosterPath;
        }
        else if ($info == 'name') {
            return $details['seasons'][$seasonCount]['name'];
        }
        else if ($info == 'air_date') {
            return new DateTime($details['seasons'][$seasonCount]['air_date']);
        }
        else if ($info == 'air_year') {
            $lastSeasonAirDateTime = new DateTime($details['seasons'][$seasonCount]['air_date']);
            $lastSeasonAirYear = $lastSeasonAirDateTime->format('Y');

            return $lastSeasonAirYear;
        }
        else if ($info == 'episode_count') {
            return $details['seasons'][$seasonCount]['episode_count'];
        }
        else if ($info == 'overview') {
            return $details['seasons'][$seasonCount]['overview'];
        }
        else {
            return 'N/A';
        }
    }

    public function getShowFirstWallpapers($showImages) {
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

        return $showWallpapersString;
    }

    public function getShowFirstVideos($showVideos) {
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

        return $showVideosString;
    }

    public function getShowFirstPosters($showImages) {
        $showPostersString = '';
        foreach ($showImages['posters'] as $index => $value) {
            if ($index <= 4) {
                $showPostersString .= '<img src="https://image.tmdb.org/t/p/w200' . $value['file_path'] . '"></img>';
            }
        }

        return $showPostersString;
    }

    public function getRecommandationsString($recommandations) {
        $recommandationsString = '';
        foreach ($recommandations['results'] as $index => $value) {
            if (!empty($value['poster_path'])) {
                $recommandationPosterPath = 'https://image.tmdb.org/t/p/w342' . $value['poster_path'];
            } else {
                $recommandationPosterPath = './Assets/images/image_unavailable.png';
            }

            $recommandationsString .= '<li class="item-' . $index . '">
            <div class="trending-box">
                <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $recommandationPosterPath . '"></a>
            </div>
        </li>';
        }

        return $recommandationsString;
    }



    public function getDetails()
    {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/tv/".$_GET['id']."?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR&region=FR&page=1");
    }

    public function getContentRating() 
    {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/tv/".$_GET['id']."/content_ratings?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR");
    }

    public function getVideos() 
    {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/tv/".$_GET['id']."/videos?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR");
    }

    public function getWatchProviders() {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/tv/".$_GET['id']."/watch/providers?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb");
    }

    public function getExternalIds() {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/tv/".$_GET['id']."/external_ids?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR");
    }

    public function getCast() {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/tv/".$_GET['id']."/credits?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR");
    }

    public function getImages() {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/tv/".$_GET['id']."/images?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb");
    }

    public function getImagesFR() {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/tv/".$_GET['id']."/images?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr");
    }

    public function addShowToDB() {
 
        $sql = 'SELECT * FROM Show WHERE idShow = :idShow';
        $showExist=parent::$db->prepare($sql);
        $showExist->execute(array(':idShow'=>$_GET['id']));
        $verif = $showExist->fetch();

        if(!$verif){
            $sql2 = 'INSERT INTO `Show` (`idShow`, `rating`) VALUES (:idShow, NULL)';
            $sth=parent::$db->prepare($sql2);
            $sth->execute(array(':idShow'=>$_GET['id']));
        }

        $results = $this->getDetails();

        foreach($results['genres'] as $genre) {
            $sql3 = 'SELECT * FROM Belong WHERE idShow = :idShow AND idGenre = :idGenre';
            $showExistInBelong=parent::$db->prepare($sql3);
            $showExistInBelong->execute(array(':idShow'=>$_GET['id'],'idGenre'=>$genre['id']));
            $verif2 = $showExistInBelong->fetch();

        if(!$verif){
            $sql3 = 'INSERT INTO Belong VALUES (:idShow, :idGenre)';
            $insertBelong=parent::$db->prepare($sql3);
            $insertBelong->execute(array(':idShow'=>$_GET['id'],'idGenre'=>$genre['id']));
        }
        }

    }

    public function getRecommandations() {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/tv/".$_GET['id']."/recommendations?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR&page=1");
    }
}
