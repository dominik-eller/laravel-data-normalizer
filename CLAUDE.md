# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Run tests
composer test

# Run tests with coverage
composer test-coverage

# Static analysis (PHPStan level 5)
composer analyse

# Fix code style (Laravel Pint)
composer format

# Run a single test file
vendor/bin/pest tests/Normalizer/PhoneNormalizerTest.php

# Run a single test by name
vendor/bin/pest --filter "normalizes phone number"
```

## Architecture

This is a Laravel package (namespace `Deller\DataNormalizer`) that provides a two-concept system:

- **Normalizers** — sanitize/standardize raw input into a canonical form (e.g. E.164 phone, lowercase email)
- **Formatters** — transform a canonical value into a human-readable display string (e.g. international phone format)

Both follow the same structural pattern:

```
Abstract base class (DataNormalizer / DataFormatter)
    ↑ extended by
Concrete implementations in src/Normalizers/ and src/Formatters/
    ↑ instantiated by
Factory classes (DataNormalizerFactory / DataFormatterFactory)
    ↑ wrapped by
Laravel Facades (Facades/DataNormalizer, Facades/DataFormatter)
    ↑ bound as singletons in
DataNormalizerServiceProvider
```

The factories hold a static `$types` registry (`['phone' => Phone::class, 'email' => Email::class]`) and expose `registerType()` for runtime extension by package consumers. The facades delegate `create(string $type)` calls to the factory singletons bound under `data-normalizer` and `data-formatter` in the container.

### Key behavioral differences between Normalizer and Formatter

- **Normalizers** throw on failure (callers must handle exceptions)
- **Formatters** catch exceptions, log a warning via `Log::warning()`, and return the original value unchanged

### Phone handling

`PhoneFormatHelper::resolveFormat()` (`src/Utils/PhoneFormatHelper.php`) translates string format names (`'E164'`, `'INTERNATIONAL'`, `'NATIONAL'`, `'RFC3966'`) or integer constants into `libphonenumber\PhoneNumberFormat` enum cases. Both the Phone normalizer and formatter use this helper. The config key `data-normalizer.phone.strict_validation` (default `false`) controls whether the normalizer rejects numbers that parse but fail `isValidNumber()`.

### Adding a new data type

1. Create `src/Normalizers/MyType.php` extending `DataNormalizer` and implement `normalize()`
2. Create `src/Formatters/MyType.php` extending `DataFormatter` and implement `format()`
3. Add the type to the `$types` arrays in both factory classes
4. Add config keys under `config/data-normalizer.php` if needed
5. Add tests in `tests/Normalizer/` and `tests/Formatter/`

## Testing

Tests use Pest with the Laravel and Arch plugins via Orchestra Testbench (no database needed). The arch test (`tests/ArchTest.php`) enforces no debug functions (`dd`, `dump`, `ray`) and applies the `php`, `laravel`, and `security` presets.

## Static Analysis

PHPStan runs at level 5 on `src/`, `config/`, and `database/`. Baseline suppressions are in `phpstan-baseline.neon`. The `DataNormalizer` and `DataFormatter` abstract base classes are marked `@codeCoverageIgnore`.
