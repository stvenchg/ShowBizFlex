<?php

require_once("./GenericView.php");
require_once("Model_Profile.php");

class ViewProfile extends GenericView
{

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ModelProfile;
    }

    public function show_profile()
    {
        $user = $this->model->getUserDetails();

        if (isset($_SESSION['login'])) {
            echo 'profile page';
        } else {
            echo "Pas identifié";
        }
    }
}
