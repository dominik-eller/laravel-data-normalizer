<?php

use Deller\DataNormalizer\Factories\DataNormalizerFactory;
use Deller\DataNormalizer\Factories\DataFormatterFactory;
use Illuminate\Support\Facades\App;

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
