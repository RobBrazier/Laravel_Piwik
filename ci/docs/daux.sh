#!/bin/sh

export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"

runScript() {
  sudo -E -u www-data -H $@
}

daux="/home/www-data/.composer/vendor/bin/daux"

CURRENT_USER=$(stat -c %u $SCRIPTS_DIR/test.sh)
CURRENT_GROUP=$(stat -c %g $SCRIPTS_DIR/test.sh)
export CURRENT_USER
export CURRENT_GROUP
[ -f "$APP_DIR/.ci-env" ] && rm "$APP_DIR/.ci-env"
sh "$SCRIPTS_DIR/setup.sh"
runScript composer global require "justinwalsh/daux.io:0.3.*"
runScript "$daux generate --format html --source docs --destination build"
chown -R "$CURRENT_USER:$CURRENT_GROUP" "$APP_DIR"
