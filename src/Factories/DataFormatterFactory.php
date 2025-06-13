<?php

declare(strict_types=1);

namespace Deller\DataNormalizer\Factories;

use Deller\DataNormalizer\DataFormatter;
use Deller\DataNormalizer\Formatters\Email;
use Deller\DataNormalizer\Formatters\Phone;
use InvalidArgumentException;

/**
 * Class DataFormatterFactory
 *
 * Factory responsible for creating formatter instances for common data types such
 * as phone numbers and email addresses. Custom formatter classes can also be
 * registered at runtime.
 */
class DataFormatterFactory
{
    protected static array $types = [
        'phone' => Phone::class,
        'email' => Email::class,
    ];

    public static function create(string $type): DataFormatter
    {
        if (! array_key_exists($type, self::$types)) {
            throw new InvalidArgumentException("Formatter type [$type] is not supported.");
        }

        $className = self::$types[$type];

        return new $className;
    }

    public static function registerType(string $type, string $class)
    {
        self::$types[$type] = $class;
    }
}
