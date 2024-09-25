<?php

namespace Deller\DataNormalizer;

use Deller\DataNormalizer\Factories\DataFormatterFactory;
use Deller\DataNormalizer\Factories\DataNormalizerFactory;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DataNormalizerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-data-normalizer')
            ->hasConfigFile();
    }

    public function packageRegistered()
    {
        $this->app->singleton('data-normalizer', function ($app) {
            return new DataNormalizerFactory;
        });

        $this->app->singleton('data-formatter', function ($app) {
            return new DataFormatterFactory;
        });
    }
}
