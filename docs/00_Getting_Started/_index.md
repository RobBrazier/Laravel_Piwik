Installation
------------

Add RobBrazier/Piwik to composer.json:

```bash
composer require "robbrazier/piwik=~3.0"
```

Setup Service Provider
----------------------

```php
// app/config/app.php
'providers' = array(
    //...
    RobBrazier\Piwik\PiwikServiceProvider::class,
    //...
);

'aliases' = array(
    //...
    'Piwik' => RobBrazier\Piwik\Facades\Piwik::class,
    //...
);
```

Publish Configuration File
--------------------------
This will create a `piwik.php` config file in `config/`
```bash
php artisan vendor:publish --provider="RobBrazier\Piwik\PiwikServiceProvider" --tag="config"
```