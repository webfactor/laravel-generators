# laravel-generators

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require webfactor/laravel-generators
```

## Usage

``` bash
php artisan make:crud entity
```

Use *singular* for entity. This will automatically create (while respecting naming conventions):

* Migration
* Factory
* Seeder
* Backpack CRUD (Model, Controller, Request)

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email thomas.swonke@webfactor.de instead of using the issue tracker.

## Credits

- [Thomas Swonke][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/webfactor/laravel-generators.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/webfactor/laravel-generators/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/webfactor/laravel-generators.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/webfactor/laravel-generators.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/webfactor/laravel-generators.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/webfactor/laravel-generators
[link-travis]: https://travis-ci.org/webfactor/laravel-generators
[link-scrutinizer]: https://scrutinizer-ci.com/g/webfactor/laravel-generators/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/webfactor/laravel-generators
[link-downloads]: https://packagist.org/packages/webfactor/laravel-generators
[link-author]: https://github.com/tswonke
[link-contributors]: ../../contributors
