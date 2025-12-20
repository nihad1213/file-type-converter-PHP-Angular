<?php

declare(strict_types=1);

namespace App\Service\Image;

use RuntimeException;

class GifToPngService
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
    
        $image = imagecreatefromgif($file['tmp_name']);
        if (!$image) {
            throw new RuntimeException('Invalid GIF file');
        }
    
        $outputName = uniqid('png_', true) . '.png';
        $outputPath = $this->outputDir . $outputName;
    
        imagepng($image, $outputPath);
        imagedestroy($image);
    
        return $outputName;
    }

}