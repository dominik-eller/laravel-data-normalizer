<?php

use Deller\DataNormalizer\Facades\DataNormalizer;
use Deller\DataNormalizer\Factories\DataNormalizerFactory;
use Deller\DataNormalizer\Normalizers\Email;  // Assuming this class exists
use Deller\DataNormalizer\Normalizers\Phone;  // Assuming this class exists

it('can resolve the phone normalizer type from the facade', function () {
    // Mock the DataFormatterFactory to return a specific formatter based on type
    $mockedFactory = mock(DataNormalizerFactory::class)
        ->shouldReceive('create')
        ->with('phone')
        ->once()
        ->andReturn(new Phone)  // Assume Phone class exists
        ->getMock();

    // Bind the mocked factory in the service container
    app()->instance('data-normalizer', $mockedFactory);

    // Test that the facade resolves to the correct instance
    $resolvedFormatter = DataNormalizer::create('phone');

    expect($resolvedFormatter)->toBeInstanceOf(Phone::class);
});

it('can resolve the email normalizer type from the facade', function () {
    // Mock the DataFormatterFactory to return a specific formatter based on type
    $mockedFactory = mock(DataNormalizerFactory::class)
        ->shouldReceive('create')
        ->with('email')
        ->once()
        ->andReturn(new Email)  // Assume Email class exists
        ->getMock();

    // Bind the mocked factory in the service container
    app()->instance('data-normalizer', $mockedFactory);

    // Test that the facade resolves to the correct instance
    $resolvedFormatter = DataNormalizer::create('email');

    expect($resolvedFormatter)->toBeInstanceOf(Email::class);
});

it('throws exception for unsupported normalizer type', function () {
    // Mock the DataFormatterFactory to throw an exception for unsupported type
    $mockedFactory = mock(DataNormalizerFactory::class)
        ->shouldReceive('create')
        ->with('unsupported-type')
        ->once()
        ->andThrow(InvalidArgumentException::class, 'Normalizer type [unsupported-type] is not supported.')
        ->getMock();

    // Bind the mocked factory in the service container
    app()->instance('data-normalizer', $mockedFactory);

    // Test that the facade throws the correct exception
    expect(fn () => DataNormalizer::create('unsupported-type'))
        ->toThrow(InvalidArgumentException::class, 'Normalizer type [unsupported-type] is not supported.');
});
