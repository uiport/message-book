<?php

namespace App\dispatcher\resolver;

use App\dispatcher\Response;

class ViewResolver
{
    public function getResponse(View $view):Response{
        $response = new Response();
        $response->setBody($view->toBody());
        return $response;
    }
}