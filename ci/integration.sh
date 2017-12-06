#!/bin/sh
set -e -x
export APP_DIR="/usr/src/app"
ci_dir="$APP_DIR/plugin/ci"
export SCRIPTS_DIR="$ci_dir/scripts"

runScript() {
  sudo -E -u www-data -H $@
}

CURRENT_USER=$(stat -c %u $SCRIPTS_DIR/test.sh)
CURRENT_GROUP=$(stat -c %g $SCRIPTS_DIR/test.sh)
export CURRENT_USER
export CURRENT_GROUP
sh "$SCRIPTS_DIR/setup.sh"
runScript "bash $SCRIPTS_DIR/laravel.sh"
cd "$APP_DIR/integration"
runScript "bash $SCRIPTS_DIR/integration.sh"
runScript "bash $SCRIPTS_DIR/integration-test.sh"
chown -R "$CURRENT_USER:$CURRENT_GROUP" "$ci_dir/.."
