<?php

namespace Deller\DataNormalizer\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Deller\DataNormalizer\DataNormalizer
 */
class DataNormalizer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'data-normalizer';  // This should match the binding name in the service provider
    }
}
