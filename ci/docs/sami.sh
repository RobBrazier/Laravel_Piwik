#!/bin/sh

set -x

export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"

sami="/home/www-data/.composer/vendor/bin/sami.php"

runScript() {
  sudo -E -u www-data -H $*
}

export CURRENT_USER=$(ls -l $SCRIPTS_DIR/test.sh | awk '{print $3}')
export CURRENT_GROUP=$(ls -l $SCRIPTS_DIR/test.sh | awk '{print $4}')
sh "$SCRIPTS_DIR/setup.sh"
runScript "bash $SCRIPTS_DIR/install.sh"
chown -R www-data:www-data ..
apk add --no-cache git
runScript composer global require "sami/sami:4.0.*"
runScript "$sami update .sami.php"
runScript "mkdir -p build"
runScript mv ../docs/api ./build/api
chown -R $CURRENT_USER:$CURRENT_GROUP $APP_DIR
