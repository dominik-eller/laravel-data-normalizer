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
     * Convert a string format (e.g. 'E164') to its corresponding libphonenumber constant.
     */
    public static function resolveFormat(string|PhoneNumberFormat|int $format): PhoneNumberFormat
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
