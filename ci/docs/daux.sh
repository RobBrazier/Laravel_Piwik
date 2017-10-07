#!/bin/sh

export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"

runScript() {
  sudo -E -u www-data -H $*
}

daux="/home/www-data/.composer/vendor/bin/daux"

export CURRENT_USER=$(ls -l $SCRIPTS_DIR/test.sh | awk '{print $3}')
export CURRENT_GROUP=$(ls -l $SCRIPTS_DIR/test.sh | awk '{print $4}')
[ -f "$APP_DIR/.ci-env" ] && rm "$APP_DIR/.ci-env"
sh "$SCRIPTS_DIR/setup.sh"
runScript composer global require "justinwalsh/daux.io:0.3.*"
runScript "$daux generate --format html --source docs --destination build"
chown -R $CURRENT_USER:$CURRENT_GROUP $APP_DIR
