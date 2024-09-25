<?php

namespace Deller\DataNormalizer\Formatters;

use Deller\DataNormalizer\DataFormatter;
use Deller\DataNormalizer\Utils\PhoneFormatHelper;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class Phone extends DataFormatter
{
    public function format(string $value, array $options = [])
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            // Get default country and format from config, allow override via options
            $defaultCountry = $options['default_country'] ?? config('data-normalizer.phone.default_country', 'DE');
            $format = $options['format'] ?? config('data-normalizer.phone.format', PhoneNumberFormat::E164);

            $formatConstant = PhoneFormatHelper::resolveFormat($format);

            $numberProto = $phoneUtil->parse($value, $defaultCountry);

            if ($phoneUtil->isValidNumber($numberProto)) {
                return $phoneUtil->format($numberProto, $formatConstant);
            }
        } catch (NumberParseException $e) {
            // Handle error
        }

        return $value;
    }
}
