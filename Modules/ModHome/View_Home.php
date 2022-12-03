<?php

require_once("GenericView.php");
require_once("Alert.php");
require_once("Model_Home.php");

class ViewHome extends GenericView
{

    private $viewAlert;
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->viewAlert = new Alert;
        $this->model = new ModelHome;
    }

    public function show_home()
    {

        if (!isset($_SESSION['login'])) {
            echo '        <div class="alpha-alert">
            
        <h1>Bienvenue sur ShowBizFlex !</h1>

        <p>Tu es actuellement sur une version démonstrative et en cours de développement.<br>Connectez-toi ou inscris-toi pour faire disparaître ce message.</p>

        <p style="color: green;">Dernière mise à jour : 17/11/2022</p>
        </div>';
        }

        echo '<div class="home">';
        $this->featured();
        $this->trendingThisWeek();
        $this->topRated();
        $this->userRecommandations();
        echo '</div>';
    }

    public function trendingThisWeek()
    {
        $res = $this->model->getTmdbTrending();

        echo '        <!-- Les séries en tendances actuellement -->
        <h4 class="trending-heading">TENDANCES ACTUELLEMENT</h4>
        <ul id="autoWidthTrending" class="cs-hidden">';

        foreach ($res['results'] as $value) {

            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];

            echo '<li class="item-' . $value['id'] . '">
            <div class="trending-box">
                <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
            </div>
        </li>';
        }

        echo  '</ul>';
    }

    public function featured()
    {

        $res = $this->model->getTmdbPopular();

        echo '<!-- Séries mise en avant -->
        <ul id="autoWidthFeatured" class="cs-hidden">';

        foreach ($res['results'] as $value) {

            $fullBackdropPath = "https://image.tmdb.org/t/p/w780/" . $value['backdrop_path'];

            echo '<li class="item-' . $value['id'] . '">
            <div class="featured-box">
                <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullBackdropPath . '"></a>
            </div>
        </li>';
        }

        echo  '</ul>';
    }

    public function topRated()
    {

        $res = $this->model->getTmdbTopRated();

        echo '<!-- Les séries les mieux notés -->
        <h4 class="toprated-heading">LES MIEUX NOTÉES</h4>

        <ul id="autoWidthTopRated" class="cs-hidden">';

        foreach ($res['results'] as $value) {

            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];

            echo '<li class="item-' . $value['id'] . '">
            <div class="toprated-box">
                <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
            </div>
        </li>';
        }

        echo  '</ul>';
    }

    public function userRecommandations()
    {

        $userGenresList = $this->model->getUserFavoriteGenres();
        $userGenresListString = '';

        if (!empty($userGenresList)) {
            foreach ($userGenresList as $genre) {
                $userGenresListString .= $genre . ',';
            }
        }

        if (!empty($userGenresList) && isset($_SESSION['login'])) {

            // Affichage des séries qui regroupent tous les genres aimés
            $allFavGenres = $this->model->getTmdbDiscoverByGenre($userGenresListString, 1);

            if ($allFavGenres['total_pages'] > 5) {
                $allFavGenres = $this->model->getTmdbDiscoverByGenre($userGenresListString, rand(1, 5));

                if ($allFavGenres['total_pages'] > 10) {
                    $allFavGenres = $this->model->getTmdbDiscoverByGenre($userGenresListString, rand(1, 10));
                }

                if ($allFavGenres['total_pages'] > 20) {
                    $allFavGenres = $this->model->getTmdbDiscoverByGenre($userGenresListString, rand(1, 20));
                }
            }

            if ($allFavGenres['total_results'] > 0) {
                echo '<!-- Recommandations de séries avec tous les genres aimés -->
                    <h4 class="toprated-heading">RECOMMANDATIONS POUR TOI</h4>

                    <ul id="autoWidthShowRecommandations" class="cs-hidden">';

                foreach ($allFavGenres['results'] as $value) {

                    $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];

                    echo '<li class="item-' . $value['id'] . '">
                        <div class="toprated-box">
                            <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                        </div>
                    </li>';
                }

                echo  '</ul>';
            }

            foreach ($userGenresList as $genre) {
                // Genre Animation /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 16) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">ANIMATION</h4>
        
                            <ul id="autoWidthShowAnimation" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // Genre Drame /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 18) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">DRAME</h4>
        
                            <ul id="autoWidthShowDrame" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // Genre Comédie /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 35) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">COMÉDIE</h4>
        
                            <ul id="autoWidthShowComedie" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // Genre Western /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 37) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">WESTERN</h4>
        
                            <ul id="autoWidthShowWestern" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // Genre Crime /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 80) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">CRIME</h4>
        
                            <ul id="autoWidthShowCrime" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // Genre Documentaire /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 99) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">DOCUMENTAIRE</h4>
        
                            <ul id="autoWidthShowDocumentaire" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // Genre Mystère /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 9648) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">MYSTÈRE</h4>
        
                            <ul id="autoWidthShowMystere" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // Genre Familial /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 10751) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">POUR LA FAMILLE</h4>
        
                            <ul id="autoWidthShowFamilial" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // Genre Action & Adventure /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 10759) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">ACTION & AVENTURE</h4>
        
                            <ul id="autoWidthShowActionAdventure" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // Genre Enfants /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 10762) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">POUR LES ENFANTS</h4>
        
                            <ul id="autoWidthShowKids" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // Genre Actualité /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 10763) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">ACTUALITÉS</h4>
        
                            <ul id="autoWidthShowNews" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // Genre Réalité /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 10764) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">RÉALITÉ</h4>
        
                            <ul id="autoWidthShowReality" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // Genre Scifi /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 10765) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">SCIENCE-FICTION & FANTASTIQUE</h4>
        
                            <ul id="autoWidthShowScifi" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // Genre Feuilleton /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 10766) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">FEUILLETON</h4>
        
                            <ul id="autoWidthShowSoap" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // Genre Talk /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 10767) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">DISCUSSION</h4>
        
                            <ul id="autoWidthShowTalk" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // Genre Guerre et Politiques /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($genre == 10768) {
                    $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, 1);

                    if ($showsWithThisGenre['total_pages'] > 5) {
                        $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 5));
        
                        if ($showsWithThisGenre['total_pages'] > 10) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 10));
                        }
        
                        if ($showsWithThisGenre['total_pages'] > 20) {
                            $showsWithThisGenre = $this->model->getTmdbDiscoverByGenre($genre, rand(1, 20));
                        }
                    }

                    if ($showsWithThisGenre['total_results'] > 0) {
                        echo '<!-- Recommandations de séries dont l\'utilisateur aime le genre -->
                            <h4 class="toprated-heading">GUERRE & POLITIQUE</h4>
        
                            <ul id="autoWidthShowWarPolitic" class="cs-hidden">';
        
                        foreach ($showsWithThisGenre['results'] as $value) {
        
                            $fullPosterPath = "https://image.tmdb.org/t/p/w342/" . $value['poster_path'];
        
                            echo '<li class="item-' . $value['id'] . '">
                                <div class="toprated-box">
                                    <a href="?module=shows&action=overview&id=' . $value['id'] . '"><img src="' . $fullPosterPath . '" loading="lazy"></a>
                                </div>
                            </li>';
                        }
        
                        echo  '</ul>';
                    }
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            }
        }
    }
}
