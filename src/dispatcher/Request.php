<?php

namespace App\dispatcher;

class Request
{
    public function getPath(){
        return $_SERVER["REQUEST_URI"];
    }
    public function getParameter(string $parameter) : string{
        return $_REQUEST[$parameter];
    }
}