#!/usr/bin/env bash

runScript() {
  sudo -E -u www-data -H $@
}

CURRENT_USER=$(stat -c %u "$SCRIPTS_DIR/test.sh")
CURRENT_GROUP=$(stat -c %g "$SCRIPTS_DIR/test.sh")
export CURRENT_USER
export CURRENT_GROUP
