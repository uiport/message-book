<?php

namespace App\dispatcher\resolver;

use App\dispatcher\Request;
use App\dispatcher\Response;

class ControllerResolver
{
    private array $urls;

    public function __construct(array $urls){
        $this->urls = $urls;
    }

    public function handle(Request $request) : Response | View{
        $path = $request->getPath();
        list($controllerClass, $controllerMethod) = $this->urls[$path];
        return (new $controllerClass())->$controllerMethod();
    }
}