---
description: Matomo Reporting API - Visitor Interest Module
---

# VisitorInterestModule

## Documentation

[https://developer.matomo.org/api-reference/reporting-api\#VisitorInterest](https://developer.matomo.org/api-reference/reporting-api#VisitorInterest)

## Module Usage

All the below methods can be called in the following manner:

```php
$visitorInterestModule = Piwik::getVisitorInterest();
$visitorInterestModule->getNumberOfVisitsPerVisitDuration($arguments, $format);
```

If you are using the format from configuration, it does not need to be specified

```php
$visitorInterestModule = Piwik::getVisitorInterest();
$visitorInterestModule->getNumberOfVisitsPerVisitDuration($arguments);
```

If you are not specifying additional arguments or a format, neither parameters need to be passed in

```php
$visitorInterestModule = Piwik::getVisitorInterest();
$visitorInterestModule->getNumberOfVisitsPerVisitDuration();
```

## Methods
TBC