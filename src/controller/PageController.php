<?php

namespace App\controller;

use App\dispatcher\resolver\View;
use App\dispatcher\Response;

class PageController
{
    public function index() : Response{
        $response = new Response();
        $response->setBody("index");
        return $response;
    }

    public function dashboard() : View{
        return new View("dashboard.html", ["user-name"=>"Nick"]);
    }
}