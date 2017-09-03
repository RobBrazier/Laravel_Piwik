#!/bin/sh
<<<<<<< HEAD
apk add bash jq sudo --no-cache
=======
apk add composer bash jq sudo --update-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/testing/
>>>>>>> c0efc5bb104fbc6dbc77ab89c15421ba73d37fc0
chown -R www-data:www-data .
