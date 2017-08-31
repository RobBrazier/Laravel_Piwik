#!/bin/sh
export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"
sh "$SCRIPTS_DIR/setup.sh"

runScript() {
  sudo -E -u www-data -H $*
}

runScript "bash $SCRIPTS_DIR/install.sh"
apk add --no-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/community \
    php7-xdebug wget openjdk8-jre
docker-php-ext-enable $(find / -name xdebug.so)
export COMPOSER_ALLOW_XDEBUG="1"
export COMPOSER_DISABLE_XDEBUG_WARN="1"
runScript "composer run-script test"
runScript "bash $SCRIPTS_DIR/sonar.sh"
