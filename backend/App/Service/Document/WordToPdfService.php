<?php

declare(strict_types=1);

namespace App\Service\Document;

use RuntimeException;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Writer\HTML;
use Mpdf\Mpdf;

class WordToPdfService
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

        try {
            $phpWord = IOFactory::load($file['tmp_name'], 'Word2007');
        } catch (\Throwable $e) {
            throw new RuntimeException('Invalid Word file');
        }

        $htmlWriter = new HTML($phpWord);

        ob_start();
        $htmlWriter->save('php://output');
        $html = ob_get_clean();

        if (!$html) {
            throw new RuntimeException('Failed to convert Word to HTML');
        }

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        $fileName = uniqid('pdf_', true) . '.pdf';
        $outputPath = $this->outputDir . $fileName;

        $mpdf->Output($outputPath, \Mpdf\Output\Destination::FILE);

        return $fileName;
    }
}
