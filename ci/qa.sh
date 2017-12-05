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
cc_reporter="/usr/local/bin/cc-test-reporter"
apk add --no-cache wget git
wget -O "$cc_reporter" https://codeclimate.com/downloads/test-reporter/test-reporter-latest-linux-amd64
chmod +x $cc_reporter
runScript "$cc_reporter before-build"
(
  runScript "composer run-script coverage"
) && (
  runScript "$cc_reporter after-build --coverage-input-type clover --exit-code $?" || true
) || (
  runScript "$cc_reporter after-build --coverage-input-type clover --exit-code $?" || true
)
chown -R $CURRENT_USER:$CURRENT_GROUP $APP_DIR
