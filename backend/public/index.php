<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controller\AbstractController;
use Src\Router;

$router = new Router();

// $router->get("/", [TestController::class, 'test']);

$router->get("/", [AbstractController::class, 'initialize']);

$router->dispatch();