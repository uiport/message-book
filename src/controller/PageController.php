<?php

namespace App\controller;

use App\dispatcher\Request;
use App\dispatcher\resolver\View;

class PageController
{
    public function index(Request $request) : View{
        return new View("index.html");
    }

    public function dashboard(Request $request) : View{
        return new View("dashboard.html", ["user-name"=>"Nick"]);
    }
}