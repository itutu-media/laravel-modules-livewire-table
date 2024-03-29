# `laravel-modules-livewire-table` is a powerful tool for Laravel developers looking to leverage the power of Livewire in their applications. With its artisan commands, Livewire integration, and configurability, it simplifies the process of creating and managing tables in Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/itutu-media/laravel-modules-livewire-table.svg?style=flat-square)](https://packagist.org/packages/itutu-media/laravel-modules-livewire-table)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/itutu-media/laravel-modules-livewire-table/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/itutu-media/laravel-modules-livewire-table/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/itutu-media/laravel-modules-livewire-table/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/itutu-media/laravel-modules-livewire-table/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/itutu-media/laravel-modules-livewire-table.svg?style=flat-square)](https://packagist.org/packages/itutu-media/laravel-modules-livewire-table)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-modules-livewire-table.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-modules-livewire-table)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require itutu-media/laravel-modules-livewire-table
```

You can publish stubs with:
  ```bash
  php artisan vendor:publish --tag=modules-livewire-table-stub
  ```

## Usage

```bash
php artisan module:make-datatable [TableName] [ModelClass] [ModuleName]
```
e.g
```bash
php artisan module:make-datatable User/UserTable App/Models/User Core
```
or
```bash
php artisan module:make-datatable User/UserTable User Core
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

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [ITUTU Media](https://github.com/itutu-media)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
