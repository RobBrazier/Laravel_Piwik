#!/bin/sh
apk add composer bash jq sudo --update-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/testing/
chown -R www-data:www-data .
