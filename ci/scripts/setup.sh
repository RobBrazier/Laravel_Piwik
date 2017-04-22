#!/bin/sh
apk add composer git bash --update-cache --repository http://dl-3.alpinelinux.org/alpine/edge/testing/
chown -R www-data:www-data .