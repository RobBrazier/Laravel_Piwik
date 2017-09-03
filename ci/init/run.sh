#!/bin/sh

export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"
sh "$SCRIPTS_DIR/setup.sh"
<<<<<<< HEAD
sudo -E -u www-data -H bash "$SCRIPTS_DIR/install.sh"
=======
sudo -E -u www-data -H bash "$SCRIPTS_DIR/install.sh" true true
>>>>>>> c0efc5bb104fbc6dbc77ab89c15421ba73d37fc0
