#!/bin/sh
set -e -x
export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"

runScript() {
  sudo -E -u www-data -H $*
}

export CURRENT_USER=$(ls -l $SCRIPTS_DIR/test.sh | awk '{print $3}')
export CURRENT_GROUP=$(ls -l $SCRIPTS_DIR/test.sh | awk '{print $4}')
sh "$SCRIPTS_DIR/setup.sh"
apk add --no-cache wget git
runScript "composer run-script coverage"
runScript "bash $SCRIPTS_DIR/codacy.sh" || true
chown -R $CURRENT_USER:$CURRENT_GROUP $APP_DIR
