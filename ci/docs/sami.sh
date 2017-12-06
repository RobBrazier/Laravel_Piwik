#!/bin/sh

set -x

export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"

sami="/home/www-data/.composer/vendor/bin/sami.php"

runScript() {
  sudo -E -u www-data -H $@
}

CURRENT_USER=$(stat -c %u $SCRIPTS_DIR/test.sh)
CURRENT_GROUP=$(stat -c %g $SCRIPTS_DIR/test.sh)
export CURRENT_USER
export CURRENT_GROUP
[ -f "$APP_DIR/.ci-env" ] && rm "$APP_DIR/.ci-env"
sh "$SCRIPTS_DIR/setup.sh"
runScript "bash $SCRIPTS_DIR/install.sh"
chown -R www-data:www-data ..
apk add --no-cache git
runScript composer global require "sami/sami:4.0.*"
runScript "$sami update .sami.php"
runScript "mkdir -p build"
runScript mv ../docs/api ./build/api
chown -R "$CURRENT_USER:$CURRENT_GROUP" "$APP_DIR"
