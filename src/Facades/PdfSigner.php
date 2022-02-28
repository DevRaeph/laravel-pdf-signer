<?php

namespace DevRaeph\PdfSigner\Facades;

use DevRaeph\PdfSigner\PdfSigner as Signer;
use Illuminate\Support\Facades\Facade;

/**
 * Class WebToPDF
 *
 * @mixin \DevRaeph\PdfSigner\PdfSigner
 *
 * @package DevRaeph\PdfSigner\Facades
 */
class PdfSigner extends Facade
{
    protected static function getFacadeAccessor()
    {
        return  Signer::class;
    }
}
