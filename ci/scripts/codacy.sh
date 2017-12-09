#!/usr/bin/env bash

set -x

composer global require codacy/coverage
/home/www-data/.composer/vendor/bin/codacycoverage clover reports/coverage.xml
