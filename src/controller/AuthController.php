<?php

namespace App\controller;

use App\dispatcher\Request;
use App\dispatcher\Response;
use App\service\AuthService;

class AuthController
{
    private AuthService $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function login(Request $request) : Response{
        return new Response();
    }

    public function logout(Request $request) : Response{
        return new Response();
    }

    public function register(Request $request) : Response{
        return new Response();
    }
}