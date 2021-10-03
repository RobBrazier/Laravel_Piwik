---
description: Matomo Reporting API - Contents Module
---

# ContentsModule

## Documentation

[https://developer.matomo.org/api-reference/reporting-api\#Contents](https://developer.matomo.org/api-reference/reporting-api#Contents)

## Module Usage

All the below methods can be called in the following manner:

```php
$contentsModule = Piwik::getContents();
$contentsModule->get($arguments, $format);
```

If you are using the format from configuration, it does not need to be specified

```php
$contentsModule = Piwik::getContents();
$contentsModule->get($arguments);
```

If you are not specifying additional arguments or a format, neither parameters need to be passed in

```php
$contentsModule = Piwik::getContents();
$contentsModule->get();
```

## Methods
TBC