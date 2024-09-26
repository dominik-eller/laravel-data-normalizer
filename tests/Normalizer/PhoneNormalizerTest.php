<?php

use Deller\DataNormalizer\Normalizers\Phone;
use Illuminate\Support\Facades\Config;

covers(Phone::class);

it('can normalize a valid phone number', function () {
    $normalizer = new Phone;

    $normalizedNumber = $normalizer->normalize('+49 151 12345678');

    // Check if it normalizes to the expected E.164 format
    expect($normalizedNumber)->toBe('+4915112345678');
});

it('throws exception for invalid phone-number', function () {
    $normalizer = new Phone;

    expect(fn () => $normalizer->normalize('invalid-phone-number'))
        ->toThrow(Exception::class,'Error parsing phone number: The string supplied did not seem to be a phone number');
});

it('throws exception for strict phone-number validation', function () {
    Config::set('data-normalizer.phone.strict_validation', true);

    $normalizer = new Phone;

    expect(fn () => $normalizer->normalize('+491234'))
        ->toThrow(Exception::class,'Invalid phone number');
});
