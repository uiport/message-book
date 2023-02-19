<?php

namespace App\dispatcher\resolver;

use App\dispatcher\Request;
use App\dispatcher\Response;
use League\MimeTypeDetection\FinfoMimeTypeDetector;

class ControllerResolver
{
    private array $urls;

    public function __construct(array $urls){
        $this->urls = $urls;
    }

    public function handle(Request $request) : Response | View
    {
        $path = $request->getPath();
        if (!array_key_exists($path, $this->urls)) {
            $response = new Response();
            $filePath = __DIR__ . "/../../../public" . $path;
            if (file_exists($filePath)) {
                $detector = new FinfoMimeTypeDetector();
                $response->setBody(file_get_contents($filePath))->setHeaders([
                    "Content-Type: " . $detector->detectMimeTypeFromPath($filePath)
                ]);
            }else{
                return new View("404.html");
            }
            return $response;
        }
        list($controllerClass, $controllerMethod) = $this->urls[$path];
        return (new $controllerClass())->$controllerMethod($request);
    }
}