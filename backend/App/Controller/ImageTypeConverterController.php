<?php

declare(strict_types=1);

namespace App\Controller;
use Throwable;
use App\Service\Image\GifToPngService;
use App\Service\Image\BmpToJpegService;

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

    public function gifToPng(): void
    {
        try {
            $service = new GifToPngService();
            $fileName = $service->convert($_FILES['image']);
            echo json_encode([
                'status' => 'success',
                'file'   => $fileName,
                'path'   => '/storage/temp/' . $fileName
            ]);
        } catch (Throwable $e) {
            http_response_code(400);
            echo json_encode([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}