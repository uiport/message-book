<?php

namespace App\controller;

use App\dispatcher\resolver\View;

class PageController
{
    public function index() : View{
        return new View("index.html");
    }

    public function dashboard() : View{
        return new View("dashboard.html", ["user-name"=>"Nick"]);
    }
}