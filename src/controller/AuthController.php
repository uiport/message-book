<?php

namespace App\controller;

use App\dispatcher\Request;
use App\dispatcher\Response;
use App\repository\UserRepository;
use App\service\AuthService;

class AuthController
{
    private AuthService $authService;

    public function __construct(AuthService $authService = new AuthService(new UserRepository([
        "mysql:host=localhost;dbname=messagebook",
        "local-token",
        "local-token"]))){
        $this->authService = $authService;
    }

    public function login(Request $request) : Response{
        $user = $this->authService->attempt([
            "name" => $request->getParameter("name"),
            "password" => $request->getParameter("password")
        ]);
        setcookie("token",$user->getSessionToken(),time()+60*60*24*30);
        return (new Response())->setBody($user->getName());
    }

    public function logout(Request $request) : Response{
        return new Response();
    }

    public function register(Request $request) : Response{
        return new Response();
    }
}