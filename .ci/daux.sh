#!/bin/sh
. $(dirname $0)/common.sh
# setup
daux="$COMPOSER_HOME/vendor/bin/daux"

composer global require "justinwalsh/daux.io:0.3.*"
$daux generate --format html --source docs --destination build
