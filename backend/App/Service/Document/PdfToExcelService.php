<?php

declare(strict_types=1);

namespace App\Service\Document;

use RuntimeException;
use Smalot\PdfParser\Parser;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PdfToExcelService
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

        $parser = new Parser();
        $pdf = $parser->parseFile($file['tmp_name']);
        $text = trim($pdf->getText());

        if ($text === '') {
            throw new RuntimeException('PDF contains no readable text');
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $rows = preg_split('/\r\n|\r|\n/', $text);
        $rowIndex = 1;

        foreach ($rows as $row) {
            $columns = preg_split('/\s{2,}/', trim($row));

            $colIndex = 1;
            foreach ($columns as $column) {
                $sheet->setCellValueByColumnAndRow($colIndex, $rowIndex, $column);
                $colIndex++;
            }

            $rowIndex++;
        }

        $fileName = uniqid('excel_', true) . '.xlsx';
        $outputPath = $this->outputDir . $fileName;

        $writer = new Xlsx($spreadsheet);
        $writer->save($outputPath);

        return $fileName;
    }
}
