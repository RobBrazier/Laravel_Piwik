#!/bin/sh
apk add composer bash jq --update-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/testing/
composer global require hirak/prestissimo
chown -R www-data:www-data .