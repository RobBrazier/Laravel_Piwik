#!/bin/sh
. $(dirname $0)/common.sh
# setup
composer install --no-suggest --no-progress
composer run-script test
