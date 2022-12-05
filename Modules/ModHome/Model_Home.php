<?php

require_once('PDOConnection.php');
require_once('Alert.php');

class ModelHome extends PDOConnection
{

    private $viewAlert;

    public function __construct()
    {
        $this->viewAlert = new Alert;
        $this->addGenres();
    }

    public function callTmdbAPI($api_url)
    {
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

    public function getTmdbTrending()
    {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/trending/tv/day?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR&region=FR&page=1");
    }

    public function getTmdbPopular()
    {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/trending/tv/week?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR&region=FR&page=1");
    }

    public function getTmdbTopRated()
    {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/tv/top_rated?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR&region=FR&page=1");
    }

    public function getTmdbLatest()
    {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/tv/top_rated?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR&region=FR&page=1");
    }

    public function getTmdbDiscoverByGenre($genres, $page)
    {
        return $this->callTmdbAPI("https://api.themoviedb.org/3/discover/tv?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR&sort_by=popularity.desc&page=$page&watch_region=FR&with_genres=$genres");
    }

    public function addGenres()
    {
        $results = $this->callTmdbAPI("https://api.themoviedb.org/3/genre/tv/list?api_key=3e4f3b0608c1d91fd1f24a37b1ddb3cb&language=fr-FR");

        foreach ($results['genres'] as $genre) {
            $sql = 'SELECT * FROM Genre WHERE idGenre = :idGenre AND nameGenre = :nameGenre';
            $qy = parent::$db->prepare($sql);
            $qy->execute(array('idGenre' => $genre['id'], 'nameGenre' => $genre['name']));
            $verif = $qy->fetch();

            if (!$verif) {
                $sql2 = 'INSERT INTO Genre VALUES (:idGenre, :nameGenre)';
                $qy2 = parent::$db->prepare($sql2);
                $qy2->execute(array('idGenre' => $genre['id'], 'nameGenre' => $genre['name']));
            }
        }
    }

    public function getUserFavoriteGenres()
    {

        if (isset($_SESSION['id'])) {

            $idUser = $_SESSION['id'];

            try {
                $stmt = parent::$db->prepare("SELECT idGenre FROM FavGenres WHERE idUser=:idUser");
                $stmt->bindParam(':idUser', $idUser);
                $stmt->execute();
                $result = $stmt->fetchAll();
                $userGenresList = array();

                foreach ($result as $genre) {
                    array_push($userGenresList, $genre['idGenre']);
                }

                return $userGenresList;
            } catch (Exception $e) {
                echo 'Erreur survenue : ',  $e->getMessage(), "\n";
            }
        }
    }
}
