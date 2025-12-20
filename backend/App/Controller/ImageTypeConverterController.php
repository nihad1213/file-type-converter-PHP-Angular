<?php

declare(strict_types=1);

namespace App\Controller;
use App\Service\Image\BmpToJpegService;
use Throwable;

class ImageTypeConverterController extends AbstractController
{
    public function bmpToJpeg(): void
    {
        try {
            $service = new BmpToJpegService();
            $fileName = $service->convert($_FILES['image']);
            echo json_encode([
                'status' => 'success',
                'file'   => $fileName,
                'path'   => '/storage/temp/' . $fileName
            ]);
        } catch (Throwable $e) {
            http_response_code(400);
        }
    }
}