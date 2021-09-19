# PHP Client for http://capap.gugik.gov.pl/api/fts/ API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/migda/gugik-php-sdk.svg?style=flat-square)](https://packagist.org/packages/migda/gugik-php-sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/migda/gugik-php-sdk/run-tests?label=tests)](https://github.com/migda/gugik-php-sdk/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/migda/gugik-php-sdk/Check%20&%20fix%20styling?label=code%20style)](https://github.com/migda/gugik-php-sdk/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/migda/gugik-php-sdk.svg?style=flat-square)](https://packagist.org/packages/migda/gugik-php-sdk)

PHP Client for http://capap.gugik.gov.pl/api/fts/ API - geocoding and reverse geocoding of administration units,
addresses, plots, etc in Poland.

This is an unofficial PHP SDK for the CAPAP GUGiK API.

## Installation

You can install the package via composer:

```bash
composer require migda/gugik-php-sdk
```

## Usage

```php
// Geocode commune

$gugik = new Gugik();

$reqs = new GcSingleJpaCollection([
    new GcSingleJpa([
        "gm_nazwa" => "dębno",
        "pow_nazwa" => "brzeski",
        "woj_nazwa" => "małopolskie",
    ]),
]);

$req = new GcReqJpa([
    'reqs' => $reqs,
]);

$results = $gugik->gcGmi($req);
$currentResult = $results->current();
```

```php
// Reverse geocode address point

$gugik = new Gugik();

$req = new RgcReqAdr([
    'd' => 500.00,
    'x' => 16.925,
    'y' => 51.089,
]);

$result = $gugik->rgcAdr($req);
```

```php
// Reverse geocode plot

$gugik = new Gugik();

$req = new RgcReqDze([
    'd' => 500.00,
    'x' => 16.925,
    'y' => 51.089,
]);

$result = $gugik->rgcDze($req);
```

### Available methods:

#### Geocoding

```php 
/**
 * Geokodowanie działek - lpis
 * Geocode plots (lpis) using post
 *
 * http://capap.gugik.gov.pl/api/fts/#_geocodedzelpisusingpost
 */
public function gcDzeLpis(GcReqDze $req): GcResultCollection

/**
 * Geokodowanie gmin
 * Geocode communes using post
 *
 * http://capap.gugik.gov.pl/api/fts/#_geocodegmiusingpost
 */
public function gcGmi(GcReqJpa $req): GcResultCollection
```

#### Reverse geocoding

```php
/**
 * Odwrotne geokodowanie - punkty adresowe
 * Reverse geocode address points using get
 *
 * http://capap.gugik.gov.pl/api/fts/#_d8df035f1b22f89d3c826789834b2d65
 */
public function rgcAdr(RgcReqAdr $req): GcResult


/**
 * Odwrotne geokodowanie - działki
 * Reverse geocode plots using get
 *
 * http://capap.gugik.gov.pl/api/fts/#_dzeusingget
 */
public function rgcDze(RgcReqDze $req): GcResult
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## TODO

1. Handle more endpoints from: http://capap.gugik.gov.pl/api/fts/
2. More complex DTO for responses (right now there is only very basic GcResult class)
3. More tests
4. Improve exceptions

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Rafal Migda](https://github.com/migda)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
