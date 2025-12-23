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

$router->post('api/v1/image/jpeg-to-jpg', [
    ImageTypeConverterController::class,
    'jpegTpJpg'
]);

$router->post('api/v1/image/jpeg-to-png', [
    ImageTypeConverterController::class,
    'jpegToPng'
]);

$router->post('api/v1/image/jpeg-to-webp', [
    ImageTypeConverterController::class,
    'jpegToWebp'
]);

$router->post('api/v1/image/jpg-to-jpeg', [
    ImageTypeConverterController::class,
    'jpgToJpeg'
]);

$router->post('api/v1/image/png-to-gif', [
    ImageTypeConverterController::class,
    'pngToGif'
]);

$router->dispatch();
