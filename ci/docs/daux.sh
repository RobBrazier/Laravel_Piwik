#!/bin/sh
set -e -x
export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"
. "$SCRIPTS_DIR/common.sh"

daux="/home/www-data/.composer/vendor/bin/daux"

{
  sh "$SCRIPTS_DIR/setup.sh"
  runScript composer global require "justinwalsh/daux.io:0.3.*"
  runScript "$daux generate --format html --source docs --destination build"
} || true
chown -R "$CURRENT_USER:$CURRENT_GROUP" "$APP_DIR"
