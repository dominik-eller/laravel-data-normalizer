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
        // Get default country from config, but allow overrides via the $options array
        $defaultCountry = $options['default_country'] ?? config('data-normalizer.phone.default_country', 'DE');

        // Get default format from config
        $format = config('data-normalizer.phone.format', PhoneNumberFormat::E164);

        $formatConstant = PhoneFormatHelper::resolveFormat($format);

        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $phoneNumberObject = $phoneUtil->parse($value, $defaultCountry);

            // Validate if strict validation is enabled
            if (config('data-normalizer.phone.strict_validation', false)) {
                if (! $phoneUtil->isValidNumber($phoneNumberObject)) {
                    throw new \Exception('Invalid phone number');
                }
            }

            return $phoneUtil->format($phoneNumberObject, $formatConstant);
        } catch (NumberParseException $e) {
            // Handle parsing errors
            throw new \Exception('Error parsing phone number: '.$e->getMessage());
        }
    }
}
