# Laravel-Piwik v3.1.0

[![Build Status](https://semaphoreci.com/api/v1/robbrazier/laravel_piwik/branches/master/shields_badge.svg)](https://semaphoreci.com/robbrazier/laravel_piwik)
[![Code Climate](https://img.shields.io/codeclimate/maintainability/RobBrazier/Laravel_Piwik.svg)](https://codeclimate.com/github/RobBrazier/Laravel_Piwik)
[![Code Climate](https://img.shields.io/codeclimate/c/RobBrazier/Laravel_Piwik.svg)](https://codeclimate.com/github/RobBrazier/Laravel_Piwik)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat)](https://php.net/)
[![Packagist Version](https://img.shields.io/packagist/v/robbrazier/piwik.svg)](https://packagist.org/packages/robbrazier/piwik)
[![Packagist Total Downloads](https://img.shields.io/packagist/dt/robbrazier/piwik.svg)](https://packagist.org/packages/robbrazier/piwik)
[![Waffle.io](https://img.shields.io/waffle/label/RobBrazier/Laravel_Piwik/in%20progress.svg)](https://waffle.io/RobBrazier/Laravel_Piwik)

An Interface to Piwik's Analytics API for Laravel (Composer Package)

This is the Laravel 5 version of the Laravel-Piwik Bundle.

## Installation

Add `RobBrazier/Piwik` to `composer.json`:

```json
{
    "require": {
        "robbrazier/piwik": "~3.1"
    }
}
```

Add `'RobBrazier\Piwik\PiwikServiceProvider'` and `'Piwik' => 'RobBrazier\Piwik\Facades\Piwik'`
to `app/config/app.php`

```php
'providers' = array(
    ...
    RobBrazier\Piwik\PiwikServiceProvider::class,
    ...
);

[...]

'aliases' = array(
    ...
    'Piwik' => RobBrazier\Piwik\Facades\Piwik::class,
    ...
);
```

Then move the config file out of the package, so that it doesn't get replaced
when you update, by running:

```bash
php artisan vendor:publish --provider="RobBrazier\Piwik\PiwikServiceProvider" --tag="config"
```

Update your packages with `composer update` or install with `composer install`.

Then go to `config/piwik.php` and add your config settings such as server,
apikey, siteid etc.

## Development

Scripts such as running unit tests for various PHP versions and integration tests
for multiple Laravel versions are configured via the `Taskfile.yml`.

They can be run locally by installing [go-task/task](https://github.com/go-task/task#installation) and then running the
commands as below:

```bash
# unit tests
PHP_VERSION=7.1 task unitTest

# integration tests
LARAVEL_VERSION=5.5 task integrationTest
```

## Documentation

Usage Documentation is located at <http://laravel-piwik.robbrazier.com/Usage.html>
API Documentation is located at <http://laravel-piwik.robbrazier.com/API_Docs.html>

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
