<?php

use Deller\DataNormalizer\Formatters\Phone;
use Illuminate\Support\Facades\Config;
use libphonenumber\PhoneNumberFormat;

it('can format a phone number in international format', function () {
    $formatter = new Phone;

    $formattedNumber = $formatter->format('+49 151 12345678', ['format' => 'INTERNATIONAL']);

    // Check if it formats to the expected international format
    expect($formattedNumber)->toBe('+49 1511 2345678');
});

it('can format a phone number in international format with constant', function () {
    $formatter = new Phone;

    $formattedNumber = $formatter->format('+49 151 12345678', ['format' => PhoneNumberFormat::INTERNATIONAL]);

    // Check if it formats to the expected international format
    expect($formattedNumber)->toBe('+49 1511 2345678');
});

it('returns original input for invalid phone number', function () {
    $formatter = new Phone;

    $formattedNumber = $formatter->format('invalid-phone-number');

    // Should return the original invalid input
    expect($formattedNumber)->toBe('invalid-phone-number');
});

it('can format a phone number using default format from config', function () {
    // Set config dynamically during test
    Config::set('data-normalizer.phone.format', 'INTERNATIONAL');

    $formatter = new Phone;

    $formattedNumber = $formatter->format('+49 151 12345678');

    // Check if it formats to the expected international format
    expect($formattedNumber)->toBe('+49 1511 2345678');
});
