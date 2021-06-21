---
description: Matomo Reporting API - Events Module
---

# EventsModule

## Documentation

[https://developer.matomo.org/api-reference/reporting-api\#Events](https://developer.matomo.org/api-reference/reporting-api#Events)

## Module Usage

All the below methods can be called in the following manner:

```php
$eventsModule = Piwik::getEvents();
$eventsModule->getCategory($arguments, $format);
```

If you are using the format from configuration, it does not need to be specified

```php
$eventsModule = Piwik::getEvents();
$eventsModule->getCategory($arguments);
```

If you are not specifying additional arguments or a format, neither parameters need to be passed in

```php
$eventsModule = Piwik::getEvents();
$eventsModule->getCategory();
```

## Methods
TBC