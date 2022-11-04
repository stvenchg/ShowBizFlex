<?php

namespace Components\CompCarousel;

require_once("./Components/CompCarousel/View_Carousel.php");
require_once("./Components/CompCarousel/Model_Carousel.php");

use Components\CompCarousel\ViewCarousel;
use Components\CompCarousel\ModelCarousel;

class ContCarousel
{

    private $view;
    private $model;

    public function __construct()
    {
        $this->view = new ViewCarousel();
        $this->model = new ModelCarousel();
    }

    public function exec()
    {
        $this->view->Carousel();
        $this->view->view();
    }
}