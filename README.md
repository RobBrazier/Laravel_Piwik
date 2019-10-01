# Laravel-Piwik v3.3.1

![Built with SemaphoreCI](https://badgen.net/badge/Built%20With/SemaphoreCI/green)
[![Code Climate](https://badgen.net/codeclimate/maintainability/RobBrazier/Laravel_Piwik)](https://codeclimate.com/github/RobBrazier/Laravel_Piwik)
[![Code Climate](https://badgen.net/codeclimate/coverage/RobBrazier/Laravel_Piwik)](https://codeclimate.com/github/RobBrazier/Laravel_Piwik)
[![Minimum PHP Version](https://badgen.net/badge/PHP/>=5.6/8892BF)](https://php.net/)
[![Packagist Version](https://badgen.net/packagist/v/robbrazier/piwik)](https://packagist.org/packages/robbrazier/piwik)
[![Packagist Total Downloads](https://badgen.net/packagist/dt/robbrazier/piwik)](https://packagist.org/packages/robbrazier/piwik)

An Interface to Piwik's Analytics API for Laravel (Composer Package)

This is the Laravel 5 version of the Laravel-Piwik Bundle.

## Installation

Add `RobBrazier/Piwik` to `composer.json`:

```json
{
    "require": {
        "robbrazier/piwik": "~3.3"
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

## Documentation

Usage Documentation is located at <https://robbrazier.github.io/Laravel_Piwik/Usage.html>
API Documentation is located at <https://robbrazier.github.io/Laravel_Piwik/API_Docs.html>

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
