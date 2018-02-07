#!/bin/sh
set -e -x
export SCRIPTS_DIR="ci/scripts"

reporter="/tmp/cc-test-reporter"
sh "$SCRIPTS_DIR/setup.sh"
apk add --no-cache curl git
curl -Lo $reporter https://codeclimate.com/downloads/test-reporter/test-reporter-latest-linux-amd64
chmod +x $reporter
$reporter before-build
exit_code="0"
{
  composer run-script coverage
  cp reports/coverage.xml clover.xml
} || {
  exit_code="$1"
}
$reporter after-build --exit-code $exit_code --coverage-input-type clover
rm clover.xml