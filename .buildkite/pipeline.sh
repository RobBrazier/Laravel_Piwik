#!/bin/bash

set -eu

declare -a PHP_VERSIONS=(5.6 7.0 7.1 7.2)
declare -a LARAVEL_VERSIONS=(5.1 5.2 5.3 5.4 5.5)

echo "steps:"
for phpver in ${PHP_VERSIONS[@]}; do
    echo "  - label: ':php: $phpver Unit'"
    echo "    command:"
    echo "      - .ci/unit.sh"
    echo "    plugins:"
    echo "      docker-compose#v2.5.0:"
    echo "        run: php${phpver//\./}"
done
echo "  - wait"
for laravelver in ${LARAVEL_VERSIONS[@]}; do
    echo "  - label: ':construction: Laravel $laravelver Smoke Test'"
    echo "    command:"
    echo "      - .ci/integration.sh"
    echo "    plugins:"
    echo "      docker-compose#v2.5.0:"
    echo "        run php72"
done
