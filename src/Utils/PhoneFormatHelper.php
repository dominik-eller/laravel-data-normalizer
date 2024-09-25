<?php

namespace Deller\DataNormalizer\Utils;

use libphonenumber\PhoneNumberFormat;

class PhoneFormatHelper
{
    protected static $formatMap = [
        'E164'          => PhoneNumberFormat::E164,
        'INTERNATIONAL' => PhoneNumberFormat::INTERNATIONAL,
        'NATIONAL'      => PhoneNumberFormat::NATIONAL,
        'RFC3966'       => PhoneNumberFormat::RFC3966,
    ];

    /**
     * Convert a string format (e.g. 'E164') to its corresponding libphonenumber constant.
     *
     * @param string|int $format
     * @return int
     */
    public static function resolveFormat(string|int $format): int
    {
        if(is_string($format)) {
            return self::$formatMap[$format] ?? PhoneNumberFormat::E164;
        } else {
            return $format;
        }
    }
}
