#!/bin/bash

set -eu

declare -a PHP_VERSIONS=(5.6 7.0 7.1 7.2)

echo "steps:"
for phpver in ${PHP_VERSIONS[@]}; do
    echo "  - label: ':php: $phpver Unit'"
    echo "    command: .ci/unit.sh"
    echo "    env:"
    echo "      BUILDKITE_DOCKER_COMPOSE_CONTAINER: php${phpver//\./}"
done