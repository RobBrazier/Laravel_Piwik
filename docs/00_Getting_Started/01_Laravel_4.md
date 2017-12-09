## Installation

Add RobBrazier/Piwik to composer.json:

```bash
composer require "robbrazier/piwik=~2.0"
```

## Setup Service Provider

```php
// app/config/app.php
'providers' = array(
    //...
    'RobBrazier\Piwik\PiwikServiceProvider',
    //...
);

'aliases' = array(
    //...
    'Piwik' => 'RobBrazier\Piwik\Facades\Piwik',
    //...
);
```

## Publish Configuration File

This will create a `piwik.php` config file in `config/`

```bash
php artisan vendor:publish --provider="RobBrazier\Piwik\PiwikServiceProvider"
```
