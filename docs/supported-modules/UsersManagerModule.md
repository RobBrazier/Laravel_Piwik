---
description: Matomo Reporting API - Users Manager Module
---

# UsersManagerModule

## Documentation

[https://developer.matomo.org/api-reference/reporting-api\#UsersManager](https://developer.matomo.org/api-reference/reporting-api#UsersManager)

## Module Usage

Some methods below can be called in the following manner:

```php
$usersManagerModule = Piwik::getUsersManager();
$usersManagerModule->getUsersPlusRole($arguments, $format);
```

If you are using the format from configuration, it does not need to be specified

```php
$usersManagerModule = Piwik::getUsersManager();
$usersManagerModule->getUsersPlusRole($arguments);
```

If you are not specifying additional arguments or a format, neither parameters need to be passed in

```php
$usersManagerModule = Piwik::getUsersManager();
$usersManagerModule->getUsersPlusRole();
```

If you are using a method which has an additional required parameter and don't need to specify additional arguments or a format, it can be called as below

```php
$usersManagerModule = Piwik::getUsersManager();
$usersManagerModule->getSitesAccessFromUser($ipRange);
```

## Methods
TBC