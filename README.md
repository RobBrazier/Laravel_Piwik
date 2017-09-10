# Laravel-Piwik v3.0.1

[![Build Status](https://semaphoreci.com/api/v1/robbrazier/laravel_piwik/branches/master/shields_badge.svg)](https://semaphoreci.com/robbrazier/laravel_piwik)
[![Sonarqube Quality Gate](https://sonarcloud.io/api/badges/gate?key=com.github.RobBrazier%3ALaravel_Piwik)](https://sonarcloud.io/dashboard?id=com.github.RobBrazier%3ALaravel_Piwik)
[![Sonarqube Code Coverage](https://sonarcloud.io/api/badges/measure?key=com.github.RobBrazier%3ALaravel_Piwik&metric=coverage)](https://sonarcloud.io/dashboard?id=com.github.RobBrazier%3ALaravel_Piwik)
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
        "robbrazier/piwik": "~3.0"
    }
}
```

Add `'RobBrazier\Piwik\PiwikServiceProvider'` and `'Piwik' => 'RobBrazier\Piwik\Facades\Piwik'` to `app/config/app.php`

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

Then move the config file out of the package, so that it doesn't get replaced when you update, by doing `php artisan vendor:publish --provider="RobBrazier\Piwik\PiwikServiceProvider" --tag="config"`.

Update your packages with `composer update` or install with `composer install`.

Then go to `config/piwik.php` and add your config settings such as server, username, password, apikey etc.

## Development
Common CI scripts are contained within a submodule, so to make use of them, the repository will need to be recursively cloned
```
git clone --recursive git@github.com:RobBrazier/Laravel_Piwik.git
git clone --recursive https://github.com/RobBrazier/Laravel_Piwik.git
```

The scripts can be used locally for running tests, e.g. integration with laravel and unit tests across php versions.
e.g.
```
# unit tests
PHP_VERSION=7.1 ./runner unitTest

# integration tests
LARAVEL_VERSION=5.5 ./runner integrationTest
```

## Documentation
Usage Documentation is located at http://laravel-piwik.robbrazier.com/Usage.html
API Documentation is located at http://laravel-piwik.robbrazier.com/API_Docs.html

## Contributing
Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
