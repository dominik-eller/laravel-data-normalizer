<?php

use Deller\DataNormalizer\Facades\DataFormatter;
use Deller\DataNormalizer\Factories\DataFormatterFactory;
use Deller\DataNormalizer\Formatters\Email;  // Assuming this class exists
use Deller\DataNormalizer\Formatters\Phone;  // Assuming this class exists

it('can resolve the phone formatter type from the facade', function () {
    // Test that the facade resolves to the correct instance
    $resolvedFormatter = DataFormatter::create('phone');

    expect($resolvedFormatter)->toBeInstanceOf(Phone::class);
});

it('can resolve the email formatter type from the facade', function () {
    // Test that the facade resolves the correct instance
    $resolvedFormatter = DataFormatter::create('email');

    expect($resolvedFormatter)->toBeInstanceOf(Email::class);
});

it('throws exception for unsupported formatter type', function () {
    // Test that the facade throws the correct exception
    expect(fn () => DataFormatter::create('unsupported-type'))
        ->toThrow(InvalidArgumentException::class, 'Formatter type [unsupported-type] is not supported.');
});
