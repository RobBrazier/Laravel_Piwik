ActionsModule
=============

## Documentation
https://developer.matomo.org/api-reference/reporting-api#Actions

## Methods

### `Piwik::getActions()->get(...)`
#### Parameters
* arguments
* format (optional)

#### Verbose Example
```php
$arguments = [
  'idSite' => 1, // if not specified, idSite from global config will be used
  'period' => 'day', // if not specified, period from global config will be used
  'date' => 'yesterday', // if not specified, date from global config will be used
  'segment' = '', // optional
  'columns' = '' // optional
]
$format = 'json'
$actions = Piwik::getActions()->get($arguments, $format)
```

#### Simplified Example
```php
$arguments = [] // will use idSite, period and date from config
$format = 'json'
$actions = Piwik::getActions()->get($arguments, $format)
```

### `Piwik::getActions()->getPageUrls(...)`
#### Parameters
* arguments
* format (optional)

#### Verbose Example
```php
$arguments = [
  'idSite' => 1,
  'period' => 'day',
  'date' => 'yesterday',
  'segment' => '', // optional
  'expanded' => '', // optional
  'idSubtable' => '', // optional
  'depth' => '', // optional
  'flat' => '' //optional
]
$format = 'json'
$pageUrls = Piwik::getActions()->getPageUrls($arguments, $format)
```

#### Simplified Example
```php
$arguments = [] // will use idSite, period and date from config
$format = 'json'
$pageUrls = Piwik::getActions()->getPageUrls($arguments, $format)
```

### `Piwik::getActions()->getPageUrlsFollowingSiteSearch(...)`
#### Parameters
* arguments
* format (optional)

#### Verbose Example
```php
$arguments = [
  'idSite' => 1,
  'period' => 'day',
  'date' => 'yesterday',
  'segment' => '', // optional
  'expanded' => '', // optional
  'idSubtable' => '' // optional
]
$format = 'json'
$pageUrls = Piwik::getActions()->getPageUrlsFollowingSiteSearch($arguments, $format)
```

#### Simplified Example
```php
$arguments = [] // will use idSite, period and date from config
$format = 'json'
$pageUrls = Piwik::getActions()->getPageUrlsFollowingSiteSearch($arguments, $format)
```

### `Piwik::getActions()->getPageTitlesFollowingSiteSearch(...)`
#### Parameters
* arguments
* format (optional)

#### Verbose Example
```php
$arguments = [
  'idSite' => 1,
  'period' => 'day',
  'date' => 'yesterday',
  'segment' => '', // optional
  'expanded' => '', // optional
  'idSubtable' => '' // optional
]
$format = 'json'
$pageTitles = Piwik::getActions()->getPageTitlesFollowingSiteSearch($arguments, $format)
```

#### Simplified Example
```php
$arguments = [] // will use idSite, period and date from config
$format = 'json'
$pageTitles = Piwik::getActions()->getPageTitlesFollowingSiteSearch($arguments, $format)
```

### `Piwik::getActions()->getEntryPageUrls(...)`
#### Parameters
* arguments
* format (optional)

#### Verbose Example
```php
$arguments = [
  'idSite' => 1,
  'period' => 'day',
  'date' => 'yesterday',
  'segment' => '', // optional
  'expanded' => '', // optional
  'idSubtable' => '', // optional
  'flat' => '' // optional
]
$format = 'json'
$entryPageUrls = Piwik::getActions()->getEntryPageUrls($arguments, $format)
```

#### Simplified Example
```php
$arguments = [] // will use idSite, period and date from config
$format = 'json'
$entryPageUrls = Piwik::getActions()->getEntryPageUrls($arguments, $format)
```