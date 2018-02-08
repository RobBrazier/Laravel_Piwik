#!/bin/sh
. $(dirname $0)/common.sh
setup
composer run-script test
