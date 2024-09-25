<?php

use Deller\DataNormalizer\Facades\DataNormalizer;
use Deller\DataNormalizer\Normalizers\Email;  // Assuming this class exists
use Deller\DataNormalizer\Normalizers\Phone;  // Assuming this class exists

it('can resolve the phone normalizer type from the facade', function () {
    // Test that the facade resolves to the correct instance
    $resolvedFormatter = DataNormalizer::create('phone');

    expect($resolvedFormatter)->toBeInstanceOf(Phone::class);
});

it('can resolve the email normalizer type from the facade', function () {
    // Test that the facade resolves to the correct instance
    $resolvedFormatter = DataNormalizer::create('email');

    expect($resolvedFormatter)->toBeInstanceOf(Email::class);
});

it('throws exception for unsupported normalizer type', function () {
    // Test that the facade throws the correct exception
    expect(fn () => DataNormalizer::create('unsupported-type'))
        ->toThrow(InvalidArgumentException::class, 'Normalizer type [unsupported-type] is not supported.');
});
