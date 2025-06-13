<?php
declare(strict_types=1);

namespace Deller\DataNormalizer\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Deller\DataNormalizer\DataFormatter
 */
class DataFormatter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'data-formatter';  // This should match the binding name in the service provider
    }
}
