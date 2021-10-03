---
description: Matomo Reporting API - Sites Manager Module
---

# SitesManagerModule

## Documentation

[https://developer.matomo.org/api-reference/reporting-api\#SitesManager](https://developer.matomo.org/api-reference/reporting-api#SitesManager)

## Module Usage

Some methods below can be called in the following manner:

```php
$sitesManagerModule = Piwik::getSitesManager();
$sitesManagerModule->getSitesWithAtLeastViewAccess($arguments, $format);
```

If you are using the format from configuration, it does not need to be specified

```php
$sitesManagerModule = Piwik::getSitesManager();
$sitesManagerModule->getSitesWithAtLeastViewAccess($arguments);
```

If you are not specifying additional arguments or a format, neither parameters need to be passed in

```php
$sitesManagerModule = Piwik::getSitesManager();
$sitesManagerModule->getSitesWithAtLeastViewAccess();
```

If you are using a method which has an additional required parameter and don't need to specify additional arguments or a format, it can be called as below

```php
$sitesManagerModule = Piwik::getSitesManager();
$sitesManagerModule->getIpsForRange($ipRange);
```

## Methods
TBC