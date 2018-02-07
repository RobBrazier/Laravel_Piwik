#!/bin/sh
set -e -x
export SCRIPTS_DIR="$(pwd)/ci/scripts"
sh "$SCRIPTS_DIR/setup.sh"
composer create-project laravel/laravel /tmp/integration "${LARAVEL_VERSION}.*" --no-progress --no-dev
bash $SCRIPTS_DIR/integration.sh
bash $SCRIPTS_DIR/integration-test.sh