<?php

declare(strict_types=1);

namespace App\Controller;

class AbstractController
{
    public function initialize(): string
    {
        return "STARTED!";
    }
}