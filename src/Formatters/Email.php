<?php

namespace Deller\DataNormalizer\Formatters;

use Deller\DataNormalizer\DataFormatter;

class Email extends DataFormatter
{
    /**
     * Format the given email address.
     *
     * @param  array  $options  Optional array to override default configuration
     */
    public function format(string $value, array $options = []): string
    {
        // Retrieve the config or use default options
        $trimWhitespace = $options['trim_whitespace'] ?? config('data-normalizer.email.trim_whitespace', true);
        $convertToLowercase = $options['lowercase'] ?? config('data-normalizer.email.lowercase', true);

        $email = $value;

        // Apply formatting steps (which may be similar to normalization)
        if ($trimWhitespace) {
            $email = trim($email);
        }

        if ($convertToLowercase) {
            $email = strtolower($email);
        }

        // You can add more formatting rules here if necessary.
        return $email;
    }
}
