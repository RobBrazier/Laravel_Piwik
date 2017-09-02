#!/bin/sh

set -x

export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"

runScript() {
  sudo -E -u www-data -H $*
}

sh "$SCRIPTS_DIR/setup.sh"
runScript "bash $SCRIPTS_DIR/install.sh" false false
chown -R www-data:www-data ..
apk add --no-cache git
runScript curl -O http://get.sensiolabs.org/sami.phar
runScript php sami.phar update .sami.php
runScript mv ../docs ./build
runScript ls -la build
