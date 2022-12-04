<?php

require_once("./GenericView.php");
require_once("Model_Search.php");

class ViewSearch extends GenericView
{

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ModelSearch;
    }

    public function show_searchResults()
    {

        if (isset($_GET['query']) && !empty($_GET['query']) && isset($_GET['page']) && !empty($_GET['page'])) {

            if ($_SESSION['adult']) {
                $showsResults = $this->model->getTmdbSearchResults(urlencode(htmlspecialchars($_GET['query'])), 'true', htmlspecialchars($_GET['page']));
            } else {
                $showsResults = $this->model->getTmdbSearchResults(urlencode(htmlspecialchars($_GET['query'])), 'false', htmlspecialchars($_GET['page']));
            }
            
            $resultsString = '';
            foreach($showsResults['results'] as $index => $value) {

                if (isset($value['first_air_date'])) {
                    $firstAirDatetime = $value['first_air_date'];
                    $firstAirDate = (new DateTime($firstAirDatetime))->format('j F Y');
                }
                else {
                    $firstAirDate = 'N/A';
                }

                if (!empty($value['poster_path'])) {
                    $posterPath = 'https://image.tmdb.org/t/p/w200' . $value['poster_path'];
                }
                else {
                    $posterPath = './Assets/images/image_unavailable.png';
                }

                $resultsString .= '<div class="search-item">
                <div class="search-item-img">
                    <a href="./?module=shows&action=overview&id='. $value['id'] .'"><img src="'. $posterPath .'" loading="lazy"/></a>
                </div>
                <div class="search-item-infos">
                    <a href="./?module=shows&action=overview&id='. $value['id'] .'"><h1>'. $value['name'] .'</h1></a>
                    <h2>'. $firstAirDate .'</h2>

                    <p>'. $value['overview'] .'</p>
                </div>
            </div>';
            }

            if (empty($resultsString)) {
                $resultsString = '<p>Aucun résultats ne correspond à ta recherche.</p>';
            }

            $pagesString = '';
            $query = urlencode(htmlspecialchars($_GET['query']));
            $currentPage = $showsResults['page'];
            $totalPages = $showsResults['total_pages'];
            
            if ($currentPage == 1) {
                $pagesString = '<a href="./?module=search&query='. $query .'&page='. ($currentPage+1) .'"><button class="btngradient btngradient-hover color-9 w-200">Suivant <i class="fa-solid fa-arrow-right"></i></button></a>';
            }
            else if ($currentPage == $totalPages) {
                $pagesString = '<a href="./?module=search&query='. $query .'&page='. ($currentPage-1) .'"><button class="btngradient btngradient-hover color-9 w-200"><i class="fa-solid fa-arrow-left"></i> Précédent</button></a>';
            } else {
                $pagesString = '
                <a href="./?module=search&query='. $query .'&page='. ($currentPage-1) .'"><button class="btngradient btngradient-hover color-9 w-200"><i class="fa-solid fa-arrow-left"></i> Précédent</button></a>
                <a href="./?module=search&query='. $query .'&page='. ($currentPage+1) .'"><button class="btngradient btngradient-hover color-9 w-200">Suivant <i class="fa-solid fa-arrow-right"></i></button></a>';
            }

            echo '<div class="searchResultsContainer">';

            echo '<div class="search-filters">
                    <div class="search-filters-box">
                    <div class="head-search-filters">
                        <h1>Voici les résultats de ta recherche pour « ' . htmlspecialchars($_GET["query"]) . ' »</h1>
                    </div>
                    <div class="search-category">
                        <div class="active-category">
                            <h2><i class="fa-solid fa-tv fa-xs"></i> Séries</h2>
                            <h2 class="search-item-count">'. $showsResults['total_results'] .'</h2>
                        </div>
                        <div>
                            <h2><i class="fa-solid fa-box-archive fa-xs"></i> Genres</h2>
                        </div>
                    </div>
                    </div>
                </div>
            
            <div class="search-results">
                ' . $resultsString . '
            </div>
        </div>
        
        <div class="search-page-selector">
            '. $pagesString . '
        </div>';

            echo '</div>';
        } else {
            echo "<container>La recherche est invalide.</container>";
        }
    }
}
