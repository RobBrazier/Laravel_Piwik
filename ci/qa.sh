#!/bin/sh
set -e -x
export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"
. "$SCRIPTS_DIR/common.sh"

{
  reporter="/tmp/cc-test-reporter"
  sh "$SCRIPTS_DIR/setup.sh"
  apk add --no-cache curl git
  runScript "curl -Lo $reporter https://codeclimate.com/downloads/test-reporter/test-reporter-latest-linux-amd64"
  runScript "chmod +x $reporter"
  runScript "$reporter before-build"
  exit_code="0"
  {
    runScript "composer run-script coverage"
    runScript "cp $APP_DIR/reports/coverage.xml $APP_DIR/clover.xml"
  } || {
    exit_code="$1"
  }
  runScript "$reporter after-build --exit-code $exit_code --coverage-input-type clover"
  runScript "rm $APP_DIR/clover.xml"
} || true
chown -R "$CURRENT_USER:$CURRENT_GROUP" "$APP_DIR"
