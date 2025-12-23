<?php

declare(strict_types=1);

namespace App\Service\Image;

use RuntimeException;

class PngToGifService
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

        $image = imagecreatefrompng($file['tmp_name']);
        if (!$image) {
            throw new RuntimeException('Invalid PNG file');
        }

        $outputName = uniqid('gif_', true) . '.gif';
        $outputPath = $this->outputDir . $outputName;

        imagegif($image, $outputPath);
        imagedestroy($image);

        return $outputName;
    }
}
