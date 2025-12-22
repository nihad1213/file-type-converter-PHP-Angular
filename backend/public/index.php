<?php

require __DIR__ . '/../vendor/autoload.php';

use Src\Router;
use App\Controller\HomeController;
use App\Controller\ImageTypeConverterController;

$router = new Router();

$router->get("/", [HomeController::class, 'home']);

// Image Routes
$router->post('/api/v1/image/bmp-to-jpeg', [
    ImageTypeConverterController::class,
    'bmpToJpeg'
]);

$router->post('/api/v1/image/gif-to-png', [
    ImageTypeConverterController::class,
    'gifToPng'
]);

$router->post('/api/v1/image/jpeg-to-bmp', [
    ImageTypeConverterController::class,
    'jpegToBmp'
]);

$router->dispatch();
