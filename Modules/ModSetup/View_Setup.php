<?php

require_once("./GenericView.php");
require_once("Model_Setup.php");

class ViewSetup extends GenericView
{

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ModelSetup;
    }

    public function show_selectGenres()
    {
        echo '

        <div class="setup-container">
            <div class="setup-title">
                <h1>'. $_SESSION['login'] .', choisis trois genres que tu aimes.</h1>

                <p>Grâce à ça, nous pourrons te recommander des séries susceptible de te plaire. <span>Sélectionne les genres que tu aimes.</span></p>
            </div>
            <div class="setup-content">
                cc
            </div>
        <div>
        
        ';
    }
}
