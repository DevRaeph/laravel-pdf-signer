<?php

namespace DevRaeph\PdfSigner;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DevRaeph\PdfSigner\PdfSigner
 */
class PdfSignerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PdfSigner::class;
    }
}
