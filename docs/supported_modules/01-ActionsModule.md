ActionsModule
=============

## Documentation
https://developer.matomo.org/api-reference/reporting-api#Actions

## Methods

### `Piwik::getActions()->get(...)`
#### Parameters
* arguments
* format (optional)
#### Example
```php
$arguments = [
  'idSite' => 1,
  'period' => 'day',
  'date' => 'yesterday'
]
$format = 'json'
$actions = Piwik::getActions()->get($arguments, $format)
```