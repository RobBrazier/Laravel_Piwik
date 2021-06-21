ActionsModule
=============

## Documentation
https://developer.matomo.org/api-reference/reporting-api#Actions

## Module Usage
All the below methods can be called in the following manner: 
```php
$actionsModule = Piwik::getActions();
$actionsModule->get($arguments, $format);
```

If you are using the format from configuration, it does not need to be specified
```php
$actionsModule = Piwik::getActions();
$actionsModule->get($arguments);
```

If you are not specifying additional arguments or a format, neither parameters need to be passed in
```php
$actionsModule = Piwik::getActions();
$actionsModule->get();
```

## Methods

### `get(...)`
#### Parameters
* arguments ([optional](#Module Usage))
* format ([optional](#Module Usage))

#### Verbose Example
```php
$arguments = [
  'idSite' => 1, // if not specified, idSite from global config will be used
  'period' => 'day', // if not specified, period from global config will be used
  'date' => 'yesterday', // if not specified, date from global config will be used
  'segment' = '', // optional
  'columns' = '' // optional
];
$format = 'json';
$actions = Piwik::getActions()->get($arguments, $format);
```

#### Simplified Example
```php
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$actions = Piwik::getActions()->get($arguments, $format);
```

### `getPageUrls(...)`
#### Parameters
* arguments ([optional](#Module Usage))
* format ([optional](#Module Usage))

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
];
$format = 'json';
$pageUrls = Piwik::getActions()->getPageUrls($arguments, $format);
```

#### Simplified Example
```php
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$pageUrls = Piwik::getActions()->getPageUrls($arguments, $format);
```

### `getPageUrlsFollowingSiteSearch(...)`
#### Parameters
* arguments ([optional](#Module Usage))
* format ([optional](#Module Usage))

#### Verbose Example
```php
$arguments = [
  'idSite' => 1,
  'period' => 'day',
  'date' => 'yesterday',
  'segment' => '', // optional
  'expanded' => '', // optional
  'idSubtable' => '' // optional
];
$format = 'json';
$pageUrls = Piwik::getActions()->getPageUrlsFollowingSiteSearch($arguments, $format);
```

#### Simplified Example
```php
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$pageUrls = Piwik::getActions()->getPageUrlsFollowingSiteSearch($arguments, $format);
```

### `getPageTitlesFollowingSiteSearch(...)`
#### Parameters
* arguments ([optional](#Module Usage))
* format ([optional](#Module Usage))

#### Verbose Example
```php
$arguments = [
  'idSite' => 1,
  'period' => 'day',
  'date' => 'yesterday',
  'segment' => '', // optional
  'expanded' => '', // optional
  'idSubtable' => '' // optional
];
$format = 'json';
$pageTitles = Piwik::getActions()->getPageTitlesFollowingSiteSearch($arguments, $format);
```

#### Simplified Example
```php
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$pageTitles = Piwik::getActions()->getPageTitlesFollowingSiteSearch($arguments, $format);
```

### `getEntryPageUrls(...)`
#### Parameters
* arguments ([optional](#Module Usage))
* format ([optional](#Module Usage))

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
];
$format = 'json';
$entryPageUrls = Piwik::getActions()->getEntryPageUrls($arguments, $format);
```

#### Simplified Example
```php
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$entryPageUrls = Piwik::getActions()->getEntryPageUrls($arguments, $format);
```

### `getExitPageUrls(...)`
#### Parameters
* arguments ([optional](#Module Usage))
* format ([optional](#Module Usage))

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
];
$format = 'json';
$exitPageUrls = Piwik::getActions()->getExitPageUrls($arguments, $format);
```

#### Simplified Example
```php
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$exitPageUrls = Piwik::getActions()->getExitPageUrls($arguments, $format);
```

### `getPageUrl(...)`
#### Parameters
* pageUrl (**required**)
* arguments ([optional](#Module Usage))
* format ([optional](#Module Usage))

#### Verbose Example
```php
$pageUrl = 'https://example.com/test';
$arguments = [
  'idSite' => 1,
  'period' => 'day',
  'date' => 'yesterday',
  'segment' => '', // optional
  'expanded' => '', // optional
  'idSubtable' => '', // optional
  'flat' => '' // optional
];
$format = 'json';
$pageUrl = Piwik::getActions()->getPageUrl($pageUrl, $arguments, $format);
```

#### Simplified Example
```php
$pageUrl = 'https://example.com/test';
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$pageUrl = Piwik::getActions()->getPageUrl($pageUrl, $arguments, $format);
```

### `getPageTitles(...)`
#### Parameters
* arguments ([optional](#Module Usage))
* format ([optional](#Module Usage))

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
];
$format = 'json';
$pageTitles = Piwik::getActions()->getPageTitles($arguments, $format);
```

#### Simplified Example
```php
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$pageTitles = Piwik::getActions()->getPageTitles($arguments, $format);
```

### `getEntryPageTitles(...)`
#### Parameters
* arguments ([optional](#Module Usage))
* format ([optional](#Module Usage))

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
];
$format = 'json';
$entryPageTitles = Piwik::getActions()->getEntryPageTitles($arguments, $format);
```

#### Simplified Example
```php
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$entryPageTitles = Piwik::getActions()->getEntryPageTitles($arguments, $format);
```