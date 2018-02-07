#!/bin/sh
set -e -x
export SCRIPTS_DIR="ci/scripts"
sh "$SCRIPTS_DIR/setup.sh"
# bash $SCRIPTS_DIR/install.sh
composer run-script test
