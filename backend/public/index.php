<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controller\TestController;
use Src\Router;

$router = new Router();

$router->get("/", [TestController::class, 'test']);

$router->dispatch();