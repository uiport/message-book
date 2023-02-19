<?php

namespace App\dispatcher;

use App\dispatcher\resolver\View;

class Response
{
    private ?array $headers;
    private ?string $body;
    private ?int $responseCode;

    public function getResponseCode(): ?int
    {
        return $this->responseCode;
    }

    public function setResponseCode(?int $responseCode): static
    {
        $this->responseCode = $responseCode;
        return $this;
    }

    public function __construct(){
        $this->headers = null;
        $this->body = null;
        $this->responseCode = null;
    }

    public function __toString(): string
    {
        return "";
    }

    public function setHeaders(array $headers) : static{
        $this->headers = $headers;
        return $this;
    }
    public function getHeaders() : ?array{
        return $this->headers;
    }
    public function setBody(string $body) : static{
        $this->body = $body;
        return $this;
    }

    public function getBody() : ?string{
        return $this->body;
    }
}
