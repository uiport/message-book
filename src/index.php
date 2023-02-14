<?php

namespace App;

use App\dispatcher\Dispatcher;
use App\dispatcher\Request;
use App\dispatcher\resolver\ControllerResolver;
use App\dispatcher\resolver\ViewResolver;

require_once "../vendor/autoload.php";

$request = new Request();
$urls = require_once "urls.php";
$dispatcher = new Dispatcher(new ControllerResolver($urls), new ViewResolver());
$dispatcher->handle($request);
