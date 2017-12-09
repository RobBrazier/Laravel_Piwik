#!/bin/sh
set -e -x
export APP_DIR="/usr/src/app"
ci_dir="$APP_DIR/plugin/ci"
export SCRIPTS_DIR="$ci_dir/scripts"
. "$SCRIPTS_DIR/common.sh"

{
  sh "$SCRIPTS_DIR/setup.sh"
  runScript "bash $SCRIPTS_DIR/laravel.sh"
  cd "$APP_DIR/integration"
  runScript "bash $SCRIPTS_DIR/integration.sh"
  runScript "bash $SCRIPTS_DIR/integration-test.sh"
} || true
chown -R "$CURRENT_USER:$CURRENT_GROUP" "$ci_dir/.."
