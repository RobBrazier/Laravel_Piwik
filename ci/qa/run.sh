#!/bin/sh
set -x
export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"
sh "$SCRIPTS_DIR/setup.sh"

runScript() {
  sudo -E -u www-data -H $*
}

<<<<<<< HEAD
apk add --no-cache wget openjdk8-jre
=======
runScript "bash $SCRIPTS_DIR/install.sh" false false
apk add --no-cache \
    wget openjdk8-jre
>>>>>>> c0efc5bb104fbc6dbc77ab89c15421ba73d37fc0
runScript "composer run-script coverage"
runScript "bash $SCRIPTS_DIR/sonar.sh"
