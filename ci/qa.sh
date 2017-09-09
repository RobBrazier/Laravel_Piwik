#!/bin/sh
set -e -x
export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"

runScript() {
  sudo -E -u www-data -H $*
}

sh "$SCRIPTS_DIR/setup.sh"
apk add --no-cache wget git openjdk8-jre
runScript "composer run-script coverage"
runScript "bash $SCRIPTS_DIR/sonar.sh"
