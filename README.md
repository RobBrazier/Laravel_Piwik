Laravel-Piwik v2.0.0
====================

An Interface to Piwik's Analytics API for Laravel (Composer Package)

This is the Laravel 4 version of the Laravel-Piwik Bundle.

I have not yet figured out tests, they will be done some time in the future, but not at the moment :)

##Installation

Add `RobBrazier/Piwik` to `composer.json`:

```javascript
{
    "require": {
        "RobBrazier/Piwik": "dev-master"
    }
}
```

Add `'RobBrazier\Piwik\PiwikServiceProvider'` and `'Piwik' => 'RobBrazier\Piwik\Facades\Piwik'` to `app/config/app.php`

```php
'providers' = array(
    ...
    'RobBrazier\Piwik\PiwikServiceProvider',
    ...
);

[...]

'aliases' = array(
    ...
    'Piwik' => 'RobBrazier\Piwik\Facades\Piwik',
    ...
);
```

Then move the config file out of the package, so that it doesn't get replaced when you update, by doing `php artisan config:publish robbrazier/piwik`.

Update your packages with `composer update` or install with `composer install`.

Then go to `app/config/packages/robbrazier/piwik/config.php` and add your config settings such as server, username, password, apikey etc.

##Manual

The Manual is still the same as version 1.0.x, and is at [http://robbrazier.com/portfolio/laravel-piwik](http://robbrazier.com/portfolio/laravel-piwik).
