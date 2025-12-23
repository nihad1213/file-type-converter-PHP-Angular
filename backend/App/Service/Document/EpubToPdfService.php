<?php

declare(strict_types=1);

namespace App\Service\Document;

use RuntimeException;
use Mpdf\Mpdf;
use HansThom\Epub\Epub;

class EpubToPdfService
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

        $epub = new Epub($file['tmp_name']);
        $chapters = $epub->getChapters();

        if (empty($chapters)) {
            throw new RuntimeException('EPUB file contains no readable chapters');
        }

        $mpdf = new Mpdf();

        foreach ($chapters as $chapter) {
            $mpdf->WriteHTML($chapter['content'] ?? '');
        }

        $outputName = uniqid('pdf_', true) . '.pdf';
        $outputPath = $this->outputDir . $outputName;

        $mpdf->Output($outputPath, \Mpdf\Output\Destination::FILE);

        return $outputName;
    }
}
