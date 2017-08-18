#!/bin/sh
export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"
sh "$SCRIPTS_DIR/setup.sh"

runScript() {
  sudo -E -u www-data -H bash $*
}

runScript "$SCRIPTS_DIR/install.sh"
apk add --no-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/community php7-xdebug
docker-php-ext-enable /usr/lib/php7/modules/xdebug.so
composer run-script test
cat reports/junit.xml
