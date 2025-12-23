<?php

declare(strict_types=1);

namespace App\Service\Document;

use RuntimeException;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Html as HtmlWriter;

class ExcelToPdfService
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
            $spreadsheet = IOFactory::load($file['tmp_name']);
        } catch (\Throwable $e) {
            throw new RuntimeException('Invalid Excel file');
        }

        $htmlWriter = new HtmlWriter($spreadsheet);
        $htmlWriter->setPreCalculateFormulas(false);

        ob_start();
        $htmlWriter->save('php://output');
        $html = ob_get_clean();

        if (!$html) {
            throw new RuntimeException('Failed to convert Excel to HTML');
        }

        $mpdf = new Mpdf([
            'orientation' => 'L',
        ]);

        $mpdf->WriteHTML($html);

        $outputName = uniqid('pdf_', true) . '.pdf';
        $outputPath = $this->outputDir . $outputName;

        $mpdf->Output($outputPath, \Mpdf\Output\Destination::FILE);

        return $outputName;
    }
}
