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
    public function hasParameter(string $parameter) : bool{
        return array_key_exists($parameter,$_REQUEST);
    }
    public function getCookie(string $name) : string{
        return $_COOKIE[$name];
    }
}