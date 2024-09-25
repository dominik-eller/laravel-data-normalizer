<?php

use Deller\DataNormalizer\Normalizers\Phone;

it('can normalize a valid phone number', function () {
    $normalizer = new Phone();

    $normalizedNumber = $normalizer->normalize('+49 151 12345678');

    // Check if it normalizes to the expected E.164 format
    expect($normalizedNumber)->toBe('+4915112345678');
});

it('returns null for invalid phone number', function () {
    $normalizer = new Phone();

    $normalizedNumber = $normalizer->normalize('invalid-phone-number');

    expect($normalizedNumber)->toBeNull();
});
