#!/bin/sh
set -e -x
export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"
. "$SCRIPTS_DIR/common.sh"

{
  sh "$SCRIPTS_DIR/setup.sh"
  runScript "bash $SCRIPTS_DIR/install.sh"
  runScript "bash $SCRIPTS_DIR/test.sh"
} || true
chown -R "$CURRENT_USER:$CURRENT_GROUP" "$APP_DIR"
