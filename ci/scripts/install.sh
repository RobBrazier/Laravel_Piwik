#!/bin/sh
if [[ "$1" -eq "true" ]]; then
  composer global require hirak/prestissimo --no-progress
fi
if [[ "$2" -eq "true" ]]; then
  composer install --no-suggest --no-progress
fi
