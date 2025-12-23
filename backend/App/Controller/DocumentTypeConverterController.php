<?php

declare(strict_types=1);

namespace App\Controller;

use Throwable;
use App\Service\Document\EpubToPdfService;
use App\Service\Document\ExcelToPdfService;

class DocumentTypeConverterController extends AbstractController
{
    public function epubToPdf(): void
    {
        try {
            $service = new EpubToPdfService();
            $fileName = $service->convert($_FILES['file']);
        
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

    public function excelToPdf(): void
    {
        try {
            $service = new ExcelToPdfService();
            $fileName = $service->convert($_FILES['file']);
        
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


}