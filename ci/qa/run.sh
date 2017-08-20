#!/bin/sh
export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"
sh "$SCRIPTS_DIR/setup.sh"

runScript() {
  sudo -E -u www-data -H $*
}

runScript "bash $SCRIPTS_DIR/install.sh"
apk add --no-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/community php7-xdebug wget ca-certificates openjdk8-jre
docker-php-ext-enable /usr/lib/php7/modules/xdebug.so
runScript "composer run-script test"
runScript "bash $SCRIPTS_DIR/sonar.sh"
