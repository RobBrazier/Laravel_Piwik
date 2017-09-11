#!/bin/sh
apk add bash jq sudo --no-cache
export CURRENT_USER=$(ls -l composer.json | awk '{print $3}')
export CURRENT_GROUP=$(ls -l composer.json | awk '{print $3}')
chown -R www-data:www-data .
