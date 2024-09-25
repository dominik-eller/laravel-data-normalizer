# A Laravel package to normalize and format data such as phone numbers, emails, and other input into standardized formats.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dominik-eller/laravel-data-normalizer.svg?style=flat-square)](https://packagist.org/packages/dominik-eller/laravel-data-normalizer)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/dominik-eller/laravel-data-normalizer/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/dominik-eller/laravel-data-normalizer/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/dominik-eller/laravel-data-normalizer/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/dominik-eller/laravel-data-normalizer/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/dominik-eller/laravel-data-normalizer.svg?style=flat-square)](https://packagist.org/packages/dominik-eller/laravel-data-normalizer)

A Laravel package to normalize and format data such as phone numbers, emails, and other input into standardized formats.

## Installation

You can install the package via composer:

```bash
composer require dominik-eller/laravel-data-normalizer
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-data-normalizer-config"
```

This is the contents of the published config file:

```php
return [
    'phone' => [
        'default_country' => 'DE',
        'format' => 'E164',
    ],
    'email' => [
        'trim_whitespace' => true,
        'lowercase' => true,
    ],
];
```

## Usage

### Normalize a phone number
```php
use Deller\DataNormalizer\Facades\PhoneNormalizer;

$normalizedPhone = PhoneNormalizer::create('phone')->normalize('+49 (151) 123 45678');
// $normalizedPhone will be "+4915112345678" (E.164 format)
```

### Format a phone number
```php
use Deller\DataNormalizer\Facades\PhoneFormatter;

$formattedPhone = PhoneFormatter::create('phone')->format('+4915112345678', ['format' => 'INTERNATIONAL']);
// $formattedPhone will be "+49 151 1234 5678"
```


### Normalize an email address
```php
use Deller\DataNormalizer\Facades\EmailNormalizer;

$normalizedEmail = EmailNormalizer::create('email')->normalize('  JohnDoe@Example.com  ');
// $normalizedEmail will be "johndoe@example.com"
```

### Format an email address
```php
use Deller\DataNormalizer\Facades\EmailFormatter;

$formattedEmail = DataFormatter::create('email')->format('  JohnDoe@Example.com  ');
// $formattedEmail will be "johndoe@example.com"
```

### Registering a custom formatter
```php
use Deller\DataNormalizer\Factories\DataFormatterFactory;

class CustomFormatter implements \Deller\DataNormalizer\DataFormatter
{
    public function format($data)
    {
        return 'Formatted: ' . strtoupper($data);
    }
}

// Register the custom formatter type
DataFormatterFactory::registerType('custom', CustomFormatter::class);

// Use the custom formatter via the facade
$customFormatter = \Deller\DataNormalizer\Facades\DataFormatter::create('custom');
echo $customFormatter->format('some data'); // Output: "Formatted: SOME DATA"
```

### Registering a custom normalizer
```php
use Deller\DataNormalizer\Factories\DataNormalizerFactory;

class CustomNormalizer implements \Deller\DataNormalizer\DataFormatter
{
    public function normalize($data)
    {
        return 'Normalized: ' . strtolower(trim($data));
    }
}

// Register the custom normalizer type
DataNormalizerFactory::registerType('custom', CustomNormalizer::class);

// Use the custom normalizer via the facade
$customNormalizer = \Deller\DataNormalizer\Facades\DataNormalizer::create('custom');
echo $customNormalizer->normalize('  SOME DATA  '); // Output: "Normalized: some data"
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please report security vulnerabilities by email to me@dominik-eller.de instead of using the issue tracker.

## Credits

- [Dominik Eller](https://github.com/dominik-eller)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
