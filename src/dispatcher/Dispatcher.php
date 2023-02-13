<?php

namespace App\dispatcher;

use App\dispatcher\resolver\ControllerResolver;
use App\dispatcher\resolver\ViewResolver;

class Dispatcher
{
    private ControllerResolver $controllerResolver;
    private ViewResolver $viewResolver;

    public function __construct(ControllerResolver $controllerResolver, ViewResolver $viewResolver)
    {
        $this->controllerResolver = $controllerResolver;
        $this->viewResolver = $viewResolver;
    }

    public function handle(Request $request) : Response{
        return new Response();
    }
}