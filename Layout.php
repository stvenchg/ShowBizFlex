<?php
    if (isset($_SESSION['login']) && $_SESSION['show_setup'] == 1 && $_GET['module'] != 'setup') {
        header('Location: ./?module=setup&action=genres');
    }
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dev - ShowBizFlex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="Assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link type="text/css" rel="stylesheet" href="Assets/css/lightslider.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="Assets/js/lightslider.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Assets/js/topbar.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    
    <?php
        require_once("Assets/js/favButton.php");
        require_once("Assets/js/checkedChange.php");
        require_once("Assets/js/saveButton.php");
        require_once("Assets/js/profileColorSelect.php");
        require_once("Assets/js/buttonLike.php");
        require_once("Assets/js/checkedChange.php");
        require_once("Assets/js/saveButton.php");
        require_once("Assets/js/profileColorSelect.php");
        require_once("Assets/js/followButton.php");
        require_once("Assets/js/unfollowButton.php");
        require_once("Assets/js/buttonComments.php");
    ?>
</head>

<body>
    <header>
        <?php
        $controller = new Controller;
        $controller->navigation();
        ?>
    </header>

    <main>

    <div class="modalSearch-bg"></div>
    <div class="search"></div>

        <?php
        global $view;
        echo $view;
        ?>
    </main>

    <footer class="footer">
        <?php
        $controller->footer();
        ?>
    </footer>

    <div class="returnToTopButton" onclick="topFunction()" id="returnToTopButton" title="Retourner en haut"><i class="fa-solid fa-arrow-up" style="line-height: 50px"></i></div>

    <script src="https://kit.fontawesome.com/e477e9361e.js" crossorigin="anonymous"></script>
    <script src="Assets/js/script.js"></script>
    <script src="Assets/js/slider.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>