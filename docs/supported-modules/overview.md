# Overview

## Common Parameters

Unless otherwise specified, the methods will accept the following arguments: 

1. `format` - a string containing one of `json`, `php`, `html`, `xml`, `rss`. If not specified in the method, it will use the format specified in your configuration file 
2. `arguments` - an associative array with the arguments that you need to pass in. If there are only one or two arguments accepted, those will be explicitly defined

## Disclaimer

* For simplicity's sake, the documentation will be showing the Facade method of usage
* All API arguments used in the examples were correct at the time of writing, new parameters may be added in the future, please reference the API docs link at the top of each page for more information

## Request a Module to be supported

If you want to request a module to be supported, please either raise a [GitHub Issue](https://github.com/RobBrazier/Laravel_Piwik/issues/new) or raise a [Pull Request](https://github.com/RobBrazier/Laravel_Piwik/pulls) with the new module \(and unit tests\)

## Common Arguments

Within the `arguments` parameter that most of the methods accept, the following parameters are purely available to override the configuration specified in the package config

1. `idSite` 
2. `period` 
3. `date`

If you do not have a need to override the values, you do not need to be specify them in each method call. This is useful when you need to manage multiple Matomo sites.

