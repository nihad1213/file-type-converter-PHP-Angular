<?php

declare(strict_types=1);

namespace App\Service\Document;

use RuntimeException;
use Smalot\PdfParser\Parser;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class PdfToWordService
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

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $lines = preg_split('/\r\n|\r|\n/', $text);

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '') {
                $section->addTextBreak();
                continue;
            }

            $section->addText($line);
        }

        $fileName = uniqid('word_', true) . '.docx';
        $outputPath = $this->outputDir . $fileName;

        IOFactory::createWriter($phpWord, 'Word2007')->save($outputPath);

        return $fileName;
    }
}
