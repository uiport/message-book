<?php

namespace App\service;

use App\model\User;
use App\repository\UserRepository;
use http\Exception\RuntimeException;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function attempt(array $credentials) : ?User{
        $user = $this->userRepository->getUserByName($credentials["name"]);
        if($user && !password_verify($credentials["password"],$user->getPasswordHash())){
            return null;
        }
        return $user;
    }

}
