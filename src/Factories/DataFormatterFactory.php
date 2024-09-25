<?php

namespace Deller\DataNormalizer\Factories;

use Deller\DataNormalizer\DataFormatter;
use Deller\DataNormalizer\Formatters\Email;
use Deller\DataNormalizer\Formatters\Phone;
use InvalidArgumentException;

/**
 * Class QrCodeFactory
 *
 * This factory class is responsible for creating different types of QR code generators.
 * It supports predefined QR code types such as URL, Text, Email, and Phone, and allows
 * registering custom QR code types dynamically.
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
