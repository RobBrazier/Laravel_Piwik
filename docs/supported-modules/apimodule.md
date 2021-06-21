---
description: Matomo Reporting API - API Module
---

# APIModule

## Documentation

[https://developer.matomo.org/api-reference/reporting-api\#API](https://developer.matomo.org/api-reference/reporting-api#API)

## Module Usage

All the below methods can be called in the following manner:

```php
$apiModule = Piwik::getAPI();
$apiModule->get($arguments, $format);
```

If you are using the format from configuration, it does not need to be specified

```php
$apiModule = Piwik::getAPI();
$apiModule->get($arguments);
```

If you are not specifying additional arguments or a format, neither parameters need to be passed in

```php
$apiModule = Piwik::getAPI();
$apiModule->get();
```

If you are using a method which has an additional required parameter and don't need to specify additional arguments or a format, it can be called as below

```php
$apiModule = Piwik::getAPI();
$apiModule->getReportMetadata($siteIds);
```

## Methods
TBC