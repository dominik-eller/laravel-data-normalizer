<?php

namespace Deller\DataNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class DataNormalizer
{
    /**
     * Normalize the given value.
     *
     * @param  array  $options  Optional parameters for customization
     * @return mixed The normalized value
     */
    abstract public function normalize(string $value, array $options = []);
}
