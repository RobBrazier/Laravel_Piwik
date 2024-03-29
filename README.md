# Laravel-Piwik v4.2.0

[![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/RobBrazier/Laravel_Piwik/build.yaml?style=flat-square&branch=master)](https://github.com/RobBrazier/Laravel_Piwik/actions)
[![Codacy grade](https://img.shields.io/codacy/grade/6e05c91a199a4ffbb2723cec35e57019?style=flat-square)](https://app.codacy.com/gh/RobBrazier/Laravel_Piwik)
[![Codacy coverage](https://img.shields.io/codacy/coverage/6e05c91a199a4ffbb2723cec35e57019?style=flat-square)](hhttps://app.codacy.com/gh/RobBrazier/Laravel_Piwik)
[![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/robbrazier/piwik?color=8892BF&style=flat-square)](https://php.net/)
[![Packagist Version](https://img.shields.io/packagist/v/robbrazier/piwik?style=flat-square)](https://packagist.org/packages/robbrazier/piwik)
[![Packagist Downloads](https://img.shields.io/packagist/dt/robbrazier/piwik?style=flat-square)](https://packagist.org/packages/robbrazier/piwik)

An Interface to Piwik's Analytics API for Laravel (Composer Package)

This is the Laravel 5+ version of the Laravel-Piwik Bundle.

> Version 4.0.0 and onwards have dropped support for PHP 5.6, 7.0 and 7.1

## Installation

Add `RobBrazier/Piwik` to `composer.json`:

```json
{
  "require": {
    "robbrazier/piwik": "~4.2"
  }
}
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

## Documentation

Usage Documentation is located at <https://docs.robbrazier.com/Laravel_Piwik/Usage.html>
API Documentation is located at <https://docs.robbrazier.com/Laravel_Piwik/API_Docs.html>

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

[![Contributors](https://contrib.rocks/image?repo=robbrazier/Laravel_Piwik)](https://github.com/RobBrazier/Laravel_Piwik/graphs/contributors)

## License

[MIT](https://choosealicense.com/licenses/mit/)
