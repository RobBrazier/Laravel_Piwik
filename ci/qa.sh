#!/bin/sh
set -e -x
export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"

runScript() {
  sudo -E -u www-data -H $*
}

export CURRENT_USER=$(ls -l composer.json | awk '{print $3}')
export CURRENT_GROUP=$(ls -l composer.json | awk '{print $3}')
sh "$SCRIPTS_DIR/setup.sh"
apk add --no-cache wget git openjdk8-jre
runScript "composer run-script coverage"
runScript "bash $SCRIPTS_DIR/sonar.sh"
chown -R $CURRENT_USER:$CURRENT_GROUP $APP_DIR
