#!/bin/sh

export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"

runScript() {
  sudo -E -u www-data -H $*
}

sh "$SCRIPTS_DIR/setup.sh"
<<<<<<< HEAD
=======
runScript "bash $SCRIPTS_DIR/install.sh" false false
>>>>>>> c0efc5bb104fbc6dbc77ab89c15421ba73d37fc0
runScript "bash $SCRIPTS_DIR/test.sh"
