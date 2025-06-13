<?php

use Deller\DataNormalizer\DataNormalizerServiceProvider;
use Deller\DataNormalizer\Factories\DataFormatterFactory;
use Deller\DataNormalizer\Factories\DataNormalizerFactory;
use Illuminate\Support\Facades\App;

covers(DataNormalizerServiceProvider::class);

it('registers data-normalizer in the container', function () {

    // Check that 'data-normalizer' resolves to the correct instance
    $dataNormalizer = App::make('data-normalizer');
    expect($dataNormalizer)->toBeInstanceOf(DataNormalizerFactory::class);
});

it('registers data-formatter in the container', function () {

    // Check that 'data-formatter' resolves to the correct instance
    $dataFormatter = App::make('data-formatter');
    expect($dataFormatter)->toBeInstanceOf(DataFormatterFactory::class);
});

it('loads the default configuration from the package', function () {
    expect(config('data-normalizer.phone.default_country'))->toBe('DE')
        ->and(config('data-normalizer.phone.format'))->toBe('E164')
        ->and(config('data-normalizer.email.trim_whitespace'))->toBeTrue()
        ->and(config('data-normalizer.email.lowercase'))->toBeTrue();
});
