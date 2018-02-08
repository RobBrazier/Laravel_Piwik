#!/bin/sh
reporter="/tmp/cc-test-reporter"
. $(dirname $0)/common.sh
setup curl git
download_executable $reporter "https://codeclimate.com/downloads/test-reporter/test-reporter-latest-linux-amd64"
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