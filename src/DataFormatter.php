<?php

namespace Deller\DataNormalizer;

abstract class DataFormatter
{
    /**
     * Format the given value into a specific output.
     *
     * @param  array  $options  Optional parameters for customization
     * @return string The formatted value
     */
    abstract public function format(string $value, array $options = []);
}
