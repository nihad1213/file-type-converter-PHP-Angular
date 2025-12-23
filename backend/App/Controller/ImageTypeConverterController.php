<?php

declare(strict_types=1);

namespace App\Controller;

use Throwable;
use App\Service\Image\GifToPngService;
use App\Service\Image\BmpToJpegService;
use App\Service\Image\JpegToBmpService;
use App\Service\Image\JpegToJpgService;
use App\Service\Image\JpegToPngService;
use App\Service\Image\JpegToWebpService;
use App\Service\Image\JpgToJpegService;
use App\Service\Image\PngToGifService;
use App\Service\Image\PngToJpegService;
use App\Service\Image\WebpToJpegService;

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
            echo json_encode([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]);
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

    public function jpegToBmp(): void
    {
        try {
            $service = new JpegToBmpService();
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

    public function jpegToJpg(): void
    {
        try {
            $service = new JpegToJpgService();
            $fileName = $service->convert($_FILES['image']);
            echo json_encode([
                'status' => 'success',
                'file' => $fileName,
                'path' => '/storage/temp/' . $fileName
            ]);
        } catch (Throwable $e) {
            http_response_code(400);
            echo json_encode([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function jpegToPng(): void
    {
        try {
            $service = new JpegToPngService();
            $fileName = $service->convert($_FILES['image']);
            echo json_encode([
                'status' => 'success',
                'file' => $fileName,
                'path' => '/storage/temp/' . $fileName
            ]);
        } catch (Throwable $e) {
            http_response_code(400);
            echo json_encode([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function jpegToWebp(): void
    {
       try {
            $service = new JpegToWebpService();
            $fileName = $service->convert($_FILES['image']);
            echo json_encode([
                'status' => 'success',
                'file' => $fileName,
                'path' => '/storage/temp/' . $fileName
            ]);
        } catch (Throwable $e) {
            http_response_code(400);
            echo json_encode([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]); 
        }
    }

    public function jpgToJpeg(): void
    {
        try {
            $service = new JpgToJpegService();
            $fileName = $service->convert($_FILES['image']);
            echo json_encode([
                'status' => 'success',
                'file' => $fileName,
                'path' => '/storage/temp/' . $fileName
            ]);
        } catch (Throwable $e) {
            http_response_code(400);
            echo json_encode([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]); 
        }
    }

    public function pngToGif(): void
    {
        try {
            $service = new PngToGifService();
            $fileName = $service->convert($_FILES['image']);
            echo json_encode([
                'status' => 'success',
                'file' => $fileName,
                'path' => '/storage/temp/' . $fileName
            ]);
        } catch (Throwable $e) {
            http_response_code(400);
            echo json_encode([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]); 
        }
    }

    public function pngToJpeg(): void
    {
        try {
            $service = new PngToJpegService();
            $fileName = $service->convert($_FILES['image']);
            echo json_encode([
                'status' => 'success',
                'file' => $fileName,
                'path' => '/storage/temp/' . $fileName
            ]);
        } catch (Throwable $e) {
            http_response_code(400);
            echo json_encode([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]); 
        }
    }
    
    public function webpToJpeg(): void
    {
        try {
            $service = new WebpToJpegService();
            $fileName = $service->convert($_FILES['image']);
            echo json_encode([
                'status' => 'success',
                'file' => $fileName,
                'path' => '/storage/temp/' . $fileName
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
