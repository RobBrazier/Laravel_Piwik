#!/bin/sh

export APP_DIR="/usr/src/app"
export SCRIPTS_DIR="$APP_DIR/ci/scripts"

npm install -g netlify-cli
netlify deploy -p build -s laravel-piwik -t $NETLIFY_TOKEN
