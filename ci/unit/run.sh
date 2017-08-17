#!/bin/sh

app_dir="/usr/src/app"
scripts_dir="$app_dir/ci/scripts"
sh "$scripts_dir/setup.sh"
sudo -u www-data -H bash "$scripts_dir/install.sh"
sudo -u www-data -H bash "$scripts_dir/test.sh"
