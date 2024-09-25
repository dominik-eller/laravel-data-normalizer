<?php

namespace Deller\DataNormalizer\Normalizers;

use Deller\DataNormalizer\DataNormalizer;
use Deller\DataNormalizer\Utils\PhoneFormatHelper;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class Phone extends DataNormalizer
{
    public function normalize(string $value, array $options = [])
    {
        // Get default country and format from config, allow override via options
        $defaultCountry = $options['default_country'] ?? config('data-normalizer.phone.default_country', 'DE');
        $format = $options['format'] ?? config('data-normalizer.phone.format', PhoneNumberFormat::E164);

        $formatConstant = PhoneFormatHelper::resolveFormat($format);

        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $numberProto = $phoneUtil->parse($value, $defaultCountry);

            if ($phoneUtil->isValidNumber($numberProto)) {
                return $phoneUtil->format($numberProto, $formatConstant);
            }
        } catch (NumberParseException $e) {
            // Handle error
        }

        return null;
    }
}
