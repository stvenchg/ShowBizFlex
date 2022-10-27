
<!DOCTYPE html>
<!--SHOWBIZFLEX-->

<html>
 
<head>
    <meta charset="UTF-8" />
    <link href="style.css" rel="stylesheet" type="text/css">
    <title> index.html </title>
</head>

<body>
    <!--Partie visible du programme-->

    <header>

    <div id="Logos">

        <a href="index.php" id="Logo"><img src="Images/LogoShowBizFlex.png" alt="Logo" /></a>

    </div>

        <?php 
            global $composantMenu;
            $composantMenu->affiche();
        ?>

    </header>

    <main>
    
        
        <?php 
            global $affichage;
            echo $affichage;
        ?>


    </main>

<footer>

    <p> ShowBizFlex © Tous droits réservés 2022  </p> 

</footer>

</body>

</html>