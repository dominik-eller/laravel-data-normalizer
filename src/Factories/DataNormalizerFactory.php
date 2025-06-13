<?php

declare(strict_types=1);

namespace Deller\DataNormalizer\Factories;

use Deller\DataNormalizer\DataNormalizer;
use Deller\DataNormalizer\Normalizers\Email;
use Deller\DataNormalizer\Normalizers\Phone;
use InvalidArgumentException;

/**
 * Class DataNormalizerFactory
 *
 * Factory responsible for creating normalizer instances for different data
 * representations like phone numbers and email addresses. Additional
 * normalizer types may be registered at runtime.
 */
class DataNormalizerFactory
{
    protected static array $types = [
        'phone' => Phone::class,
        'email' => Email::class,
    ];

    public static function create(string $type): DataNormalizer
    {
        if (! array_key_exists($type, self::$types)) {
            throw new InvalidArgumentException("Normalizer type [$type] is not supported.");
        }

        $className = self::$types[$type];

        return new $className;
    }

    public static function registerType(string $type, string $class)
    {
        self::$types[$type] = $class;
    }
}
