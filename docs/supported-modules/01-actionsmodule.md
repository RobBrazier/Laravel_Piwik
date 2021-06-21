# ActionsModule

## Documentation

[https://developer.matomo.org/api-reference/reporting-api\#Actions](https://developer.matomo.org/api-reference/reporting-api#Actions)

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

If you are using a method which has an additional required parameter and don't need to specify additional arguments or a format, it can be called as below

```php
$actionsModule = Piwik::getActions();
$actionsModule->getPageTitle($pageName);
```

## Methods

### `get(...)`

#### Parameters

* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

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

* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

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

* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

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

* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

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

* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

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

* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

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

* pageUrl \(**required**\)
* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

#### Verbose Example

```php
$pageUrl = 'https://example.com/test';
$arguments = [
  'idSite' => 1,
  'period' => 'day',
  'date' => 'yesterday',
  'segment' => '' // optional
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

* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

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

* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

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

### `getExitPageTitles(...)`

#### Parameters

* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

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
$exitPageTitles = Piwik::getActions()->getExitPageTitles($arguments, $format);
```

#### Simplified Example

```php
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$exitPageTitles = Piwik::getActions()->getExitPageTitles($arguments, $format);
```

### `getPageTitle(...)`

#### Parameters

* pageName \(**required**\)
* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

#### Verbose Example

```php
$pageName = 'test';
$arguments = [
  'idSite' => 1,
  'period' => 'day',
  'date' => 'yesterday',
  'segment' => '' // optional
];
$format = 'json';
$pageTitle = Piwik::getActions()->getPageTitle($pageName, $arguments, $format);
```

#### Simplified Example

```php
$pageName = 'test';
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$pageTitle = Piwik::getActions()->getPageTitle($pageName, $arguments, $format);
```

### `getDownloads(...)`

#### Parameters

* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

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
$downloads = Piwik::getActions()->getDownloads($arguments, $format);
```

#### Simplified Example

```php
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$downloads = Piwik::getActions()->getDownloads($arguments, $format);
```

### `getDownload(...)`

#### Parameters

* downloadUrl \(**required**\)
* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

#### Verbose Example

```php
$downloadUrl = 'https://example.com/test';
$arguments = [
  'idSite' => 1,
  'period' => 'day',
  'date' => 'yesterday',
  'segment' => '' // optional
];
$format = 'json';
$download = Piwik::getActions()->getDownload($downloadUrl, $arguments, $format);
```

#### Simplified Example

```php
$downloadUrl = 'https://example.com/test';
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$download = Piwik::getActions()->getDownload($downloadUrl, $arguments, $format);
```

### `getOutlinks(...)`

#### Parameters

* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

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
$outlinks = Piwik::getActions()->getOutlinks($arguments, $format);
```

#### Simplified Example

```php
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$outlinks = Piwik::getActions()->getOutlinks($arguments, $format);
```

### `getOutlink(...)`

#### Parameters

* outlinkUrl \(**required**\)
* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

#### Verbose Example

```php
$outlinkUrl = 'https://example.com/test';
$arguments = [
  'idSite' => 1,
  'period' => 'day',
  'date' => 'yesterday',
  'segment' => '' // optional
];
$format = 'json';
$outlink = Piwik::getActions()->getOutlink($outlinkUrl, $arguments, $format);
```

#### Simplified Example

```php
$outlinkUrl = 'https://example.com/test';
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$outlink = Piwik::getActions()->getOutlink($outlinkUrl, $arguments, $format);
```

### `getSiteSearchKeywords(...)`

#### Parameters

* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

#### Verbose Example

```php
$arguments = [
  'idSite' => 1,
  'period' => 'day',
  'date' => 'yesterday',
  'segment' => '' // optional
];
$format = 'json';
$siteSearchKeywords = Piwik::getActions()->getSiteSearchKeywords($arguments, $format);
```

#### Simplified Example

```php
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$siteSearchKeywords = Piwik::getActions()->getSiteSearchKeywords($arguments, $format);
```

### `getSiteSearchNoResultKeywords(...)`

#### Parameters

* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

#### Verbose Example

```php
$arguments = [
  'idSite' => 1,
  'period' => 'day',
  'date' => 'yesterday',
  'segment' => '' // optional
];
$format = 'json';
$siteSearchNoResultKeywords = Piwik::getActions()->getSiteSearchNoResultKeywords($arguments, $format);
```

#### Simplified Example

```php
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$siteSearchNoResultKeywords = Piwik::getActions()->getSiteSearchNoResultKeywords($arguments, $format);
```

### `getSiteSearchCategories(...)`

#### Parameters

* arguments \([optional](01-actionsmodule.md#module-usage)\)
* format \([optional](01-actionsmodule.md#module-usage)\)

#### Verbose Example

```php
$arguments = [
  'idSite' => 1,
  'period' => 'day',
  'date' => 'yesterday',
  'segment' => '' // optional
];
$format = 'json';
$siteSearchCategories = Piwik::getActions()->getSiteSearchCategories($arguments, $format);
```

#### Simplified Example

```php
$arguments = []; // will use idSite, period and date from config
$format = 'json';
$siteSearchCategories = Piwik::getActions()->getSiteSearchCategories($arguments, $format);
```

