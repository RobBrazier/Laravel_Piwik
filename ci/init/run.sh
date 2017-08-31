#!/bin/sh

export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"
sh "$SCRIPTS_DIR/setup.sh"
sudo -E -u www-data -H bash "$SCRIPTS_DIR/install.sh" true true
