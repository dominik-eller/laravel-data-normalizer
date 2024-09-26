<?php

use Deller\DataNormalizer\DataNormalizer;
use Deller\DataNormalizer\Factories\DataNormalizerFactory;
use Deller\DataNormalizer\Normalizers\Email;
use Deller\DataNormalizer\Normalizers\Phone;

covers(DataNormalizerFactory::class);

it('creates a Phone normalizer', function () {
    // Test that the factory creates the Phone formatter when 'phone' is requested
    $formatter = DataNormalizerFactory::create('phone');

    expect($formatter)->toBeInstanceOf(Phone::class);
});

it('creates an Email normalizer', function () {
    // Test that the factory creates the Email formatter when 'email' is requested
    $formatter = DataNormalizerFactory::create('email');

    expect($formatter)->toBeInstanceOf(Email::class);
});

it('throws an exception for unsupported normalizer type', function () {
    // Test that an InvalidArgumentException is thrown for an unsupported formatter type
    expect(fn () => DataNormalizerFactory::create('unsupported-type'))
        ->toThrow(InvalidArgumentException::class, 'Normalizer type [unsupported-type] is not supported.');
});

it('can register and create a custom normalizer type', function () {
    // Define a custom formatter class
    class CustomNormalizer extends DataNormalizer
    {
        public function normalize($value, array $options = [])
        {
            return "custom: {$value}";
        }
    }

    // Register the custom formatter type
    DataNormalizerFactory::registerType('custom', CustomNormalizer::class);

    // Test that the factory can create the custom formatter
    $formatter = DataNormalizerFactory::create('custom');

    expect($formatter)->toBeInstanceOf(CustomNormalizer::class);
});
