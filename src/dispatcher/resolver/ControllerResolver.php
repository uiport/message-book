<?php

namespace App\dispatcher\resolver;

class ControllerResolver
{
    private array $urls;

    public function __construct(array $urls){
        $this->urls = $urls;
    }
}