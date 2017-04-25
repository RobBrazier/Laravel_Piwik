#!/bin/sh
composer global require hirak/prestissimo
composer create-project laravel/laravel integration "${LARAVEL_VERSION}.*" --no-progress --no-dev