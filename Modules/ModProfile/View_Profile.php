<?php

require_once("./GenericView.php");

class ViewProfile extends GenericView
{

    private $model;

    public function __construct()
    {
        parent::__construct();
    }

    public function show_profile($user)
    {
        if (isset($_SESSION['login'])) {
            foreach($user as $row){
                echo 'Identifiant : ' . $row["username"] . "<br> <br>";
                echo 'Description : ' . $row["about"] . "<br> <br>";
            }
            echo 'Avatar : ' . '<img src="/Assets/images/avatar/'. $row['avatar_file'] . '"</img>' . "<br> <br> <br>";
            echo 'Bannière : ' . '<img src="/Assets/images/banner/' . $row['banner_file'] . '" . width="300px" </img>';
        } else {
            echo "Pas identifié";
        }
    }

    public function show_others_profile(){

    }

}
