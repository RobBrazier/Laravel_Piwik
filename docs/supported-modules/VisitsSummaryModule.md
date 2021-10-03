---
description: Matomo Reporting API - Visits Summary Module
---

# VisitsSummaryModule

## Documentation

[https://developer.matomo.org/api-reference/reporting-api\#VisitsSummary](https://developer.matomo.org/api-reference/reporting-api#VisitsSummary)

## Module Usage

All the below methods can be called in the following manner:

```php
$visitsSummaryModule = Piwik::getVisitsSummary();
$visitsSummaryModule->get($arguments, $format);
```

If you are using the format from configuration, it does not need to be specified

```php
$visitsSummaryModule = Piwik::getVisitsSummary();
$visitsSummaryModule->get($arguments);
```

If you are not specifying additional arguments or a format, neither parameters need to be passed in

```php
$visitsSummaryModule = Piwik::getVisitsSummary();
$visitsSummaryModule->get();
```

## Methods
TBC