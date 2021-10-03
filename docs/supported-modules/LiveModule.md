---
description: Matomo Reporting API - Live Module
---

# LiveModule

## Documentation

[https://developer.matomo.org/api-reference/reporting-api\#Live](https://developer.matomo.org/api-reference/reporting-api#Live)

## Module Usage

All the below methods can be called in the following manner:

```php
$liveModule = Piwik::getLive();
$liveModule->getLastVisitsDetails($arguments, $format);
```

If you are using the format from configuration, it does not need to be specified

```php
$liveModule = Piwik::getLive();
$liveModule->getLastVisitsDetails($arguments);
```

If you are not specifying additional arguments or a format, neither parameters need to be passed in

```php
$liveModule = Piwik::getLive();
$liveModule->getLastVisitsDetails();
```

If you are using a method which has an additional required parameter and don't need to specify additional arguments or a format, it can be called as below

```php
$liveModule = Piwik::getLive();
$liveModule->getCounters($lastMinutes);
```

## Methods
TBC