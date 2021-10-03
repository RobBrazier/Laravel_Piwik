---
description: Matomo Reporting API - Referrers Module
---

# ReferrersModule

## Documentation

[https://developer.matomo.org/api-reference/reporting-api\#Referrers](https://developer.matomo.org/api-reference/reporting-api#Referrers)

## Module Usage

All the below methods can be called in the following manner:

```php
$referrersModule = Piwik::getReferrers();
$referrersModule->get($arguments, $format);
```

If you are using the format from configuration, it does not need to be specified

```php
$referrersModule = Piwik::getReferrers();
$referrersModule->get($arguments);
```

If you are not specifying additional arguments or a format, neither parameters need to be passed in

```php
$referrersModule = Piwik::getReferrers();
$referrersModule->get();
```

## Methods
TBC