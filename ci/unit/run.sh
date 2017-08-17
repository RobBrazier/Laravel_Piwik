#!/bin/sh

app_dir="/usr/src/app"
scripts_dir="$app_dir/ci/scripts"
sh "$scripts_dir/setup.sh"
bash "$scripts_dir/install.sh"
bash "$scripts_dir/test.sh"
