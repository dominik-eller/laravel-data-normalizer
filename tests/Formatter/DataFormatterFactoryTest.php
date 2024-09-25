<?php

use Deller\DataNormalizer\Factories\DataFormatterFactory;
use Deller\DataNormalizer\Formatters\Email;
use Deller\DataNormalizer\Formatters\Phone;

it('creates a Phone formatter', function () {
    // Test that the factory creates the Phone formatter when 'phone' is requested
    $formatter = DataFormatterFactory::create('phone');

    expect($formatter)->toBeInstanceOf(Phone::class);
});

it('creates an Email formatter', function () {
    // Test that the factory creates the Email formatter when 'email' is requested
    $formatter = DataFormatterFactory::create('email');

    expect($formatter)->toBeInstanceOf(Email::class);
});

it('throws an exception for unsupported formatter type', function () {
    // Test that an InvalidArgumentException is thrown for an unsupported formatter type
    expect(fn () => DataFormatterFactory::create('unsupported-type'))
        ->toThrow(InvalidArgumentException::class, 'Formatter type [unsupported-type] is not supported.');
});

it('can register and create a custom formatter type', function () {
    // Define a custom formatter class
    class CustomFormatter extends \Deller\DataNormalizer\DataFormatter
    {
        public function format($value, array $options = [])
        {
            return "custom: {$value}";
        }
    }

    // Register the custom formatter type
    DataFormatterFactory::registerType('custom', CustomFormatter::class);

    // Test that the factory can create the custom formatter
    $formatter = DataFormatterFactory::create('custom');

    expect($formatter)->toBeInstanceOf(CustomFormatter::class);
});
