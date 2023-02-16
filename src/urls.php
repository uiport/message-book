<?php

namespace App;

use App\controller\AuthController;
use App\controller\PageController;

return [
    "/" => [PageController::class, "index"],
    "/dashboard" => [PageController::class, "dashboard"],
    "/login" => [AuthController::class, "login"],
    "/register" => [AuthController::class, "register"],
    "/logout" => [AuthController::class, "logout"]
];