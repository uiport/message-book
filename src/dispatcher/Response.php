<?php

namespace App\dispatcher;

use App\dispatcher\resolver\View;

class Response
{
    private ?array $headers;
    private ?string $body;

    public function __construct(){
        $this->headers = null;
        $this->body = null;
    }

    public function __toString(): string
    {
        return "";
    }

    public function setHeaders(array $headers) : void{
        $this->headers = $headers;
    }
    public function getHeaders() : ?array{
        return $this->headers;
    }
    public function setBody(string $body) : void{
        $this->body = $body;
    }

    public function getBody() : ?string{
        return $this->body;
    }
}