<?php

declare(strict_types=1);

namespace App\Service\Image;

use RuntimeException;

class JpgToJpegService
{
    private string $outputDir;

    public function __construct()
    {
        $this->outputDir = __DIR__ . '/../../../storage/temp';
    }

    public function convert(array $file): string
    {
        if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
            throw new RuntimeException('Invalid upload');
        }

        $image = imagecreatefromjpeg($file['tmp_name']);
        if (!$image) {
            throw new RuntimeException('Invalid JPG file');
        }

        $outputName = uniqid('jpeg_', true) . '.jpeg';
        $outputPath = $this->outputDir . $outputName;

        imagejpeg($image, $outputPath);
        imagedestroy($image);

        return $outputName;
    }
}
