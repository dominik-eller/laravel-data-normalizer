<?php

use Deller\DataNormalizer\Utils\PhoneFormatHelper;
use libphonenumber\PhoneNumberFormat;

covers(PhoneFormatHelper::class);

it('resolves E164 string to corresponding constant', function () {
    $resolved = PhoneFormatHelper::resolveFormat('E164');

    // Assert that it resolves to PhoneNumberFormat::E164
    expect($resolved)->toBe(PhoneNumberFormat::E164);
});

it('resolves INTERNATIONAL string to corresponding constant', function () {
    $resolved = PhoneFormatHelper::resolveFormat('INTERNATIONAL');

    // Assert that it resolves to PhoneNumberFormat::INTERNATIONAL
    expect($resolved)->toBe(PhoneNumberFormat::INTERNATIONAL);
});

it('resolves NATIONAL string to corresponding constant', function () {
    $resolved = PhoneFormatHelper::resolveFormat('NATIONAL');

    // Assert that it resolves to PhoneNumberFormat::NATIONAL
    expect($resolved)->toBe(PhoneNumberFormat::NATIONAL);
});

it('resolves RFC3966 string to corresponding constant', function () {
    $resolved = PhoneFormatHelper::resolveFormat('RFC3966');

    // Assert that it resolves to PhoneNumberFormat::RFC3966
    expect($resolved)->toBe(PhoneNumberFormat::RFC3966);
});

it('defaults to E164 for unknown string format', function () {
    $resolved = PhoneFormatHelper::resolveFormat('UNKNOWN_FORMAT');

    // Assert that it defaults to PhoneNumberFormat::E164 for unknown formats
    expect($resolved)->toBe(PhoneNumberFormat::E164);
});

it('returns integer format directly when passed', function () {
    $resolved = PhoneFormatHelper::resolveFormat(PhoneNumberFormat::INTERNATIONAL);

    // Assert that it returns the constant as-is when passed as an integer
    expect($resolved)->toBe(PhoneNumberFormat::INTERNATIONAL);
});

it('returns E164 when an empty string is passed', function () {
    $resolved = PhoneFormatHelper::resolveFormat('');

    // Assert that it defaults to PhoneNumberFormat::E164 for empty strings
    expect($resolved)->toBe(PhoneNumberFormat::E164);
});
