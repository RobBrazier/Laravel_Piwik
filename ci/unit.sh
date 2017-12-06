#!/bin/sh
set -e -x
export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"

runScript() {
  sudo -E -u www-data -H $@
}
CURRENT_USER=$(stat -c %u $SCRIPTS_DIR/test.sh)
CURRENT_GROUP=$(stat -c %g $SCRIPTS_DIR/test.sh)
export CURRENT_USER
export CURRENT_GROUP
sh "$SCRIPTS_DIR/setup.sh"
runScript "bash $SCRIPTS_DIR/install.sh"
runScript "bash $SCRIPTS_DIR/test.sh"
chown -R "$CURRENT_USER:$CURRENT_GROUP" "$APP_DIR"
