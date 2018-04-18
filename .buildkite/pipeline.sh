#!/bin/bash

set -eu

declare -a PHP_VERSIONS=(5.6 7.0 7.1 7.2)

echo "steps:"
for phpver in ${PHP_VERSIONS[@]}; do
    echo "  - label: ':php: $phpver Unit'"
    echo "    command:"
    echo "      - composer install --no-suggest --no-progress"
    echo "      - .ci/unit.sh"
    echo "    plugins:"
    echo "      docker-compose#v2.0.0:"
    echo "        run: php${phpver//\./}"
done
