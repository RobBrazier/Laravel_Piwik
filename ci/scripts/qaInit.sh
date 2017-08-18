#!/bin/sh
export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"
sh "$SCRIPTS_DIR/setup.sh"

runScript() {
  sudo -E -u www-data -H bash $*
}

runScript "$SCRIPTS_DIR/install.sh"
