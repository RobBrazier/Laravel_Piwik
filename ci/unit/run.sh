#!/bin/sh

export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"

runScript() {
  sudo -E -u www-data -H $*
}

sh "$SCRIPTS_DIR/setup.sh"
runScript "bash $SCRIPTS_DIR/test.sh"
