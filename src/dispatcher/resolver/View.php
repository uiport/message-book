<?php

namespace App\dispatcher\resolver;

class View
{
    private ?array $parameters;
    private string $fileName;

    public function __construct(string $fileName, ?array $parameters = null){
        $this->fileName = $fileName;
        $this->parameters = $parameters;
    }

    public function toBody() : string{
        $content = file_get_contents(dirname(__DIR__,2) . "/view/$this->fileName");
        if ($this->parameters !== null){
            $names = array_keys($this->parameters);
            $names = array_map(function (string $name){
                return "{{" . $name . "}}";
            },$names);
            $content = str_replace($names, array_values($this->parameters), $content);
        }
        return $content;
    }
}