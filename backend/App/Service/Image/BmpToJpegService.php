<?php

declare(strict_types=1);

namespace App\Service\Image;

use RuntimeException;

class BmpToJpegService
{
    private string $outputDir;

    public function __construct()
    {
        $this->outputDir = __DIR__ . '/../../../storage/temp/';
    }
    
    public function convert(array $file): string
    {
        if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
            throw new RuntimeException('Invalid upload');
        }

        $image = imagecreatefrombmp($file['tmp_name']);
        if (!$image) {
            throw new RuntimeException('Invalid BMP file');
        }

        $outputName = uniqid('jpeg_', true) . '.jpg';
        $outputPath = $this->outputDir . $outputName;

        imagejpeg($image, $outputPath, 90);
        imagedestroy($image);

        return $outputName;
    }
}