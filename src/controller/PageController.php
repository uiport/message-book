<?php

namespace App\controller;

use App\dispatcher\Request;
use App\dispatcher\resolver\View;
use App\dispatcher\resolver\ViewResolver;
use App\dispatcher\Response;
use App\service\AuthService;
use App\repository\UserRepository;

class PageController
{
    private AuthService $authService;

    public function __construct(AuthService $authService = new AuthService(new UserRepository([
        "mysql:host=localhost;dbname=messagebook",
        "root",
        "root"]))){
        $this->authService = $authService;
    }
    public function index(Request $request) : View{
        return new View("index.html");
    }

    public function dashboard(Request $request) : View|Response{
        $user = $this->authService->attemptByToken($request->getCookie("token"));
        if(!isset($user)){
            return (new Response())->setResponseCode(302)->setHeaders([
                "Location: http://localhost:9090/login"
            ]);
        }
        return new View("dashboard.html", ["user-name"=>$user->getName()]);
    }
}