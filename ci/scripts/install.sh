#!/bin/sh
set -x
if [[ "$1" == "true" ]]; then
  composer global require hirak/prestissimo --no-progress
fi
if [[ "$2" == "true" ]]; then
  composer install --no-suggest --no-progress
fi
