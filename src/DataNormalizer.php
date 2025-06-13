<?php

declare(strict_types=1);

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
