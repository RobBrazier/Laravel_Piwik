#!/bin/sh

app_dir="/usr/src/app"
scripts_dir="$app_dir/ci/scripts"
exec "$scripts_dir/setup.sh"
exec "$scripts_dir/install.sh"
exec "$scripts_dir/test.sh"
