#!/bin/sh
<<<<<<< HEAD
composer install --no-suggest --no-progress
=======
set -x
if [[ "$1" == "true" ]]; then
  composer global require hirak/prestissimo --no-progress
fi
if [[ "$2" == "true" ]]; then
  composer install --no-suggest --no-progress
fi
>>>>>>> c0efc5bb104fbc6dbc77ab89c15421ba73d37fc0
