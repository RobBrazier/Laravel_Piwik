#!/bin/sh
set -e -x
export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"
. "$SCRIPTS_DIR/common.sh"

sami="/home/www-data/.composer/vendor/bin/sami.php"

{
  sh "$SCRIPTS_DIR/setup.sh"
  runScript "bash $SCRIPTS_DIR/install.sh"
  chown -R www-data:www-data ..
  apk add --no-cache git
  runScript composer global require "sami/sami:4.0.*"
  runScript "$sami update .sami.php"
  runScript "mkdir -p build"
  runScript mv ../docs/api ./build/api
} || true
chown -R "$CURRENT_USER:$CURRENT_GROUP" "$APP_DIR"
