<?php

use Deller\DataNormalizer\Normalizers\Email;

it('normalizes an email by trimming whitespace and converting to lowercase', function () {
    $normalizer = new Email;

    $normalizedEmail = $normalizer->normalize('  EXAMPLE@DOMAIN.COM  ');

    expect($normalizedEmail)->toBe('example@domain.com');
});
