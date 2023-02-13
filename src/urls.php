<?php

namespace App;

use App\controller\AuthController;
use App\controller\PageController;

return [
    "/" => [PageController::class, "index"],
    "/login" => [AuthController::class, "index"],
    "/register" => [AuthController::class, "register"],
    "/dashboard" => [PageController::class, "dashboard"],
    "/logout" => [AuthController::class, "logout"]
];