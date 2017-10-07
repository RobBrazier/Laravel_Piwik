#!/bin/sh
apk add bash jq sudo --no-cache
chown -R www-data:www-data .
[ -f "$APP_DIR/.ci-env" ] && rm "$APP_DIR/.ci-env"
