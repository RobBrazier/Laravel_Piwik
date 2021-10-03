---
description: Matomo Reporting API - SEO Module
---

# SEOModule

## Documentation

[https://developer.matomo.org/api-reference/reporting-api\#SEO](https://developer.matomo.org/api-reference/reporting-api#SEO)

## Module Usage

All the below methods can be called in the following manner:

```php
$seoModule = Piwik::getSEO();
$seoModule->getRank($url, $format);
$seoModule->getRankFromSiteId($siteId, $format);
```

If you are using the format from configuration, it does not need to be specified

```php
$seoModule = Piwik::getReferrers();
$seoModule->getRank($url);
$seoModule->getRankFromSiteId($siteId);
```

## Methods
TBC