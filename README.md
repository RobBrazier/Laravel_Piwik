Laravel-Piwik v3.0.0
====================

[![Build Status](https://semaphoreci.com/api/v1/robbrazier/laravel_piwik/branches/master/shields_badge.svg)](https://semaphoreci.com/robbrazier/laravel_piwik)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/robbrazier/laravel_piwik.svg)](https://scrutinizer-ci.com/g/RobBrazier/Laravel_Piwik/)
[![Codecov](https://img.shields.io/codecov/c/github/RobBrazier/Laravel_Piwik.svg)](https://codecov.io/gh/RobBrazier/Laravel_Piwik)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat)](https://php.net/)
[![Packagist Version](https://img.shields.io/packagist/v/robbrazier/piwik.svg)](https://packagist.org/packages/robbrazier/piwik)
[![Packagist Total Downloads](https://img.shields.io/packagist/dt/robbrazier/piwik.svg)](https://packagist.org/packages/robbrazier/piwik)
[![Waffle.io](https://img.shields.io/waffle/label/RobBrazier/Laravel_Piwik/in%20progress.svg)](https://waffle.io/RobBrazier/Laravel_Piwik)

An Interface to Piwik's Analytics API for Laravel (Composer Package)

This is the Laravel 5 version of the Laravel-Piwik Bundle.

Installation
------------

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

Manual
------

The Manual is still the same as version 1.0.x, and is at [http://robbrazier.com/projects/laravel-piwik](http://robbrazier.com/projects/laravel-piwik).
