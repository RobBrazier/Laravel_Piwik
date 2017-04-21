#!/bin/sh
composer global require phpunit/phpunit>=${PHPUNIT_VERSION} --prefer-source
composer install --prefer-source