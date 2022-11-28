<?php

require_once('PDOConnection.php');
require_once('Alert.php');

class ModelShows extends PDOConnection
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
                $stmt = parent::$db->prepare("SELECT COUNT(*) FROM towatchlatershows WHERE idUser=:idUser AND idShow=:idShow");
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


    public function sendComments(){
        $idShow = $_GET['id'];
        try{
            $requestSendComments = parent::$db->prepare("INSERT INTO Comment VALUES (NULL, :comment, :idUser, :idShow, NULL)");
            if(isset($_POST['commentaire']) && isset($idShow) && isset($_SESSION['id'])){
                $requestSendComments->execute(array(":comment" => $_POST['commentaire'], "idUser" => $_SESSION['id'], ":idShow" => $idShow));
            }
        }
        catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }

    public function deleteComments(){
        $idCom = $_GET['idCom'];
        $idUser = $_GET['idUser'];
        $idRole = $_SESSION['idRole'];

        if($idUser == $_SESSION['id']){
            try {
                $requestdeleteComments = parent::$db->prepare("DELETE FROM Comment WHERE idCom = ?");
                $requestdeleteComments->execute(array($idCom));
                echo 'Commentaire supprimé !';
            }
            catch (Exception $e) {
                echo 'Erreur survenue : ',  $e->getMessage(), "\n";
            }
        }

        if($idRole == 1){
            try {
                $requestdeleteCommentsAdmin = parent::$db->prepare("DELETE FROM Comment WHERE idCom = ?");
                $requestdeleteCommentsAdmin->execute(array($idCom));
                echo 'Commentaire supprimé !';
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

    public function getSimilar() {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/tv/".$_GET['id']."/similar?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR&page=1");
    }
}
