#!/bin/sh

set -x

export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"

sami="/home/www-data/.composer/vendor/bin/sami.php"

runScript() {
  sudo -E -u www-data -H $*
}

sh "$SCRIPTS_DIR/setup.sh"
runScript "bash $SCRIPTS_DIR/install.sh" true false
chown -R www-data:www-data ..
apk add --no-cache git
runScript composer global require "sami/sami:4.0.*"
runScript "$sami update .sami.php"
runScript mv ../docs ./build
runScript ls -la build
