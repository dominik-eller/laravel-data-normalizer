<?php

namespace Deller\DataNormalizer\Normalizers;

use Deller\DataNormalizer\DataNormalizer;

class Email extends DataNormalizer
{
    /**
     * Normalize the given email address.
     *
     * @param  array  $options  Optional array to override default configuration
     */
    public function normalize(string $value, array $options = []): string
    {
        // Retrieve the config or use default options
        $trimWhitespace = $options['trim_whitespace'] ?? config('data-normalizer.email.trim_whitespace', true);
        $convertToLowercase = $options['lowercase'] ?? config('data-normalizer.email.lowercase', true);

        $email = $value;

        // Apply normalizing steps
        if ($trimWhitespace) {
            $email = trim($email);
        }

        if ($convertToLowercase) {
            $email = strtolower($email);
        }

        return $email;
    }
}
