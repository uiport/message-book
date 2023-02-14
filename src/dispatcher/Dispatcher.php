<?php

namespace App\dispatcher;

use App\dispatcher\resolver\ControllerResolver;
use App\dispatcher\resolver\View;
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

    public function handle(Request $request) : void{
        $output = $this->controllerResolver->handle($request);
        if($output instanceof View){
            $output = $this->viewResolver->getResponse($output);
        }
        $this->send($output);
    }

    protected function send(Response $response):void{
        $headers = $response->getHeaders();
        if($headers !== null)
            array_walk($headers,function (string $header){
                header($header);
            });
        echo $response->getBody();
    }
}