#!/bin/sh
export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"
sh "$SCRIPTS_DIR/setup.sh"

runScript() {
  sudo -E -u www-data -H $*
}

runScript "bash $SCRIPTS_DIR/install.sh"
pecl install xdebug
docker-php-ext-enable $(find / -name xdebug.so)
runScript "composer run-script test"
runScript "bash $SCRIPTS_DIR/sonar.sh"
