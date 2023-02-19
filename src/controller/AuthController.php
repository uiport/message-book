<?php

namespace App\controller;

use App\dispatcher\Request;
use App\dispatcher\resolver\View;
use App\dispatcher\Response;
use App\model\User;
use App\repository\UserRepository;
use App\service\AuthService;
use Ramsey\Uuid\Uuid;

class AuthController
{
    private AuthService $authService;

    public function __construct(AuthService $authService = new AuthService(new UserRepository([
        "mysql:host=localhost;dbname=messagebook",
        "local-token",
        "local-token"]))){
        $this->authService = $authService;
    }

    public function login(Request $request) : Response|View{
        if(!$request->hasParameter("name") || !$request->hasParameter("password")){
            return new View("login.html");
        }
        $user = $this->authService->attempt([
            "name" => $request->getParameter("name"),
            "password" => $request->getParameter("password")
        ]);
        setcookie("token",$user->getSessionToken(),time()+60*60*24*30);
        return (new Response())->setBody("success login");
    }

    public function logout(Request $request) : Response{
        if(isset($_COOKIE["token"])){
            setcookie("token","");
        }
        return (new Response())->setBody('Success logout');
    }

    public function register(Request $request) : Response{
        $user = new User(
            0,
            $request->getParameter("name"),
            password_hash($request->getParameter("password"), PASSWORD_DEFAULT),
            Uuid::uuid4()
        );
        $returnedUser = $this->authService->persistUser($user);
        setcookie("token",$returnedUser->getSessionToken(),time()+60*60*24*30);
        return (new Response())->setBody("success register");
    }
}