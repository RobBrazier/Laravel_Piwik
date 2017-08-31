#!/bin/sh
set -x
export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"
sh "$SCRIPTS_DIR/setup.sh"

runScript() {
  sudo -E -u www-data -H $*
}

runScript "bash $SCRIPTS_DIR/install.sh" false false
apk add --no-cache \
    wget openjdk8-jre
runScript "composer run-script coverage"
runScript "bash $SCRIPTS_DIR/sonar.sh"
