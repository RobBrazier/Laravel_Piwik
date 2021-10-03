# Laravel 5 and above

## Installation

Add RobBrazier/Piwik to composer.json:

```bash
composer require "robbrazier/piwik=~4.1"
```

### For Laravel 5.4 and below

Add `'RobBrazier\Piwik\PiwikServiceProvider'` and `'Piwik' => 'RobBrazier\Piwik\Facades\Piwik'`
to `app/config/app.php`

```php
'providers' = [
    ...
    RobBrazier\Piwik\PiwikServiceProvider::class,
    ...
],

[...]

'aliases' = [
    ...
    'Piwik' => RobBrazier\Piwik\Facades\Piwik::class,
    ...
],
```

### For Laravel 5.5 and above, no app.php changes are required as the autoloader will pick up the required configuration

Then move the config file out of the package, so that it doesn't get replaced
when you update, by running:

```bash
php artisan vendor:publish --provider="RobBrazier\Piwik\PiwikServiceProvider" --tag="config"
```

Update your packages with `composer update` or install with `composer install`.

Then go to `config/piwik.php` and add your config settings such as server,
apikey, siteid etc.