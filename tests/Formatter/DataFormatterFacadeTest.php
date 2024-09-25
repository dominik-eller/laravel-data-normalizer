<?php

use Deller\DataNormalizer\Facades\DataFormatter;
use Deller\DataNormalizer\Factories\DataFormatterFactory;
use Deller\DataNormalizer\Formatters\Phone;  // Assuming this class exists
use Deller\DataNormalizer\Formatters\Email;  // Assuming this class exists

it('can resolve the phone formatter type from the facade', function () {
    // Mock the DataFormatterFactory to return a specific formatter based on type
    $mockedFactory = mock(DataFormatterFactory::class)
        ->shouldReceive('create')
        ->with('phone')
        ->once()
        ->andReturn(new Phone())  // Assume Phone class exists
        ->getMock();

    // Bind the mocked factory in the service container
    app()->instance('data-formatter', $mockedFactory);

    // Test that the facade resolves to the correct instance
    $resolvedFormatter = DataFormatter::create('phone');

    expect($resolvedFormatter)->toBeInstanceOf(Phone::class);
});

it('can resolve the email formatter type from the facade', function () {
    // Mock the DataFormatterFactory to return a specific formatter based on type
    $mockedFactory = mock(DataFormatterFactory::class)
        ->shouldReceive('create')
        ->with('email')
        ->once()
        ->andReturn(new Email())  // Assume Phone class exists
        ->getMock();

    // Bind the mocked factory in the service container
    app()->instance('data-formatter', $mockedFactory);

    // Test that the facade resolves to the correct instance
    $resolvedFormatter = DataFormatter::create('email');

    expect($resolvedFormatter)->toBeInstanceOf(Email::class);
});

it('throws exception for unsupported formatter type', function () {
    // Mock the DataFormatterFactory to throw an exception for unsupported type
    $mockedFactory = mock(DataFormatterFactory::class)
        ->shouldReceive('create')
        ->with('unsupported-type')
        ->once()
        ->andThrow(InvalidArgumentException::class, "Formatter type [unsupported-type] is not supported.")
        ->getMock();

    // Bind the mocked factory in the service container
    app()->instance('data-formatter', $mockedFactory);

    // Test that the facade throws the correct exception
    expect(fn () => DataFormatter::create('unsupported-type'))
        ->toThrow(InvalidArgumentException::class, "Formatter type [unsupported-type] is not supported.");
});
