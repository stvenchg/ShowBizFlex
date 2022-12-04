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

        if (isset($_GET['query']) && !empty($_GET['query'])) {

            if ($_SESSION['adult']) {
                $showsResults = $this->model->getTmdbSearchResults('true');
            } else {
                $showsResults = $this->model->getTmdbSearchResults('false');
            }
            
            $resultsString = '';
            foreach($showsResults['results'] as $index => $value) {
                if (!empty($value['poster_path'])) {
                    $posterPath = 'https://image.tmdb.org/t/p/w200' . $value['poster_path'];
                }
                else {
                    $posterPath = './Assets/images/image_unavailable.png';
                }

                $resultsString .= '<div class="grid-item"><a href="./?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $posterPath . '"></a></div>';
            }

            $query = htmlspecialchars($_GET['query']);

            echo '<div class="searchResultsContainer">';

            echo '<div class="search-filters">
                    <div class="head-search-filters">
                        <h1>Voici les résultats de ta recherche pour « ' . htmlspecialchars($_GET["query"]) . ' »</h1>
                    </div>
                    <div class="search-category">
                        <div class="active-category">
                            <h2><i class="fa-solid fa-tv fa-xs"></i> Séries</h2>
                        </div>
                        <div>
                            <h2><i class="fa-solid fa-box-archive fa-xs"></i> Genres</h2>
                        </div>
                    </div>
                </div>
            
            <div class="search-results">
                <div class="search-item">
                    
                </div>
            </div>';

            echo '</div>';
        } else {
            echo "<container>Id non définie</container>";
        }
    }
}
