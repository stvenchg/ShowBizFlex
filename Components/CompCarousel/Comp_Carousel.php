<?php

namespace Components\CompCarousel;

require_once("./Components/CompCarousel/Cont_Carousel.php");
use Components\CompCarousel\ContCarousel;

class CompCarousel
{

    public function __construct()
    {
        $controller = new ContCarousel();
        $controller->exec();
    }
}
