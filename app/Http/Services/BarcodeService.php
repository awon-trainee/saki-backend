<?php

namespace App\Http\Services;

use Picqer\Barcode\BarcodeGeneratorPNG;

class BarcodeService
{
    public function link(string $text): string {
        return url("/barcode/{$text}");
    }
}