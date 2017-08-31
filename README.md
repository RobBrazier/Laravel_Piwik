Laravel-Piwik v3.0.1
====================

[![Jenkins](https://img.shields.io/jenkins/s/https/ci.brazier.cloud/job/RobBrazier/job/Laravel_Piwik/job/master.svg)](https://ci.brazier.cloud/blue/organizations/jenkins/RobBrazier%2FLaravel_Piwik/branches)
[![Sonarqube Quality Gate](https://sonarcloud.io/api/badges/gate?key=com.github.RobBrazier%3ALaravel_Piwik)](https://sonarcloud.io/dashboard?id=com.github.RobBrazier%3ALaravel_Piwik)
[![Sonarqube Code Coverage](https://sonarcloud.io/api/badges/measure?key=com.github.RobBrazier%3ALaravel_Piwik&metric=coverage)](https://sonarcloud.io/dashboard?id=com.github.RobBrazier%3ALaravel_Piwik)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat)](https://php.net/)
[![Packagist Version](https://img.shields.io/packagist/v/robbrazier/piwik.svg)](https://packagist.org/packages/robbrazier/piwik)
[![Packagist Total Downloads](https://img.shields.io/packagist/dt/robbrazier/piwik.svg)](https://packagist.org/packages/robbrazier/piwik)
[![Waffle.io](https://img.shields.io/waffle/label/RobBrazier/Laravel_Piwik/in%20progress.svg)](https://waffle.io/RobBrazier/Laravel_Piwik)
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bhttps%3A%2F%2Fgithub.com%2FRobBrazier%2FLaravel_Piwik.svg?type=shield)](https://app.fossa.io/projects/git%2Bhttps%3A%2F%2Fgithub.com%2FRobBrazier%2FLaravel_Piwik?ref=badge_shield)

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
