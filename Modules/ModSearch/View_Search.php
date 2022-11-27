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

        echo '<style>
            main {
                height: 100vh;
            }
        </style>';

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

            echo '<div class="searchContainer">';
                echo '<h1>Résultats de la recherche pour : ' . $query . '</h1>';

                echo '<div class="resultsContainer">';

                echo $resultsString;

                echo '</div>';

            echo '</div>';
        } else {
            echo "<container>Id non définie</container>";
        }
    }
}
