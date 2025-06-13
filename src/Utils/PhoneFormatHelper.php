<?php

namespace Deller\DataNormalizer\Utils;

use libphonenumber\PhoneNumberFormat;

class PhoneFormatHelper
{
    protected static $formatMap = [
        'E164' => PhoneNumberFormat::E164,
        'INTERNATIONAL' => PhoneNumberFormat::INTERNATIONAL,
        'NATIONAL' => PhoneNumberFormat::NATIONAL,
        'RFC3966' => PhoneNumberFormat::RFC3966,
    ];

    /**
     * Convert a string or integer representation of a phone number format into
     * its corresponding {@link PhoneNumberFormat} enum case. When an enum case
     * is provided it will be returned unchanged.
     */
    public static function resolveFormat(string|int|PhoneNumberFormat $format): PhoneNumberFormat
    {
        if ($format instanceof PhoneNumberFormat) {
            return $format;
        }

        if (is_string($format)) {
            return self::$formatMap[$format] ?? PhoneNumberFormat::E164;
        }

        return PhoneNumberFormat::from($format);
    }
}
