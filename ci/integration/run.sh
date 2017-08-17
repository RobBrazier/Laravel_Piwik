#!/bin/sh

app_dir="/usr/src/app"
ci_dir="$app_dir/../ci"
scripts_dir="$ci_dir/scripts"
mv "$app_dir/plugin/ci" "$ci_dir"
sh "$scripts_dir/setup.sh"
sudo -u www-data -H bash "$scripts_dir/laravel.sh"
mkdir -p "$app_dir/integration"
cd "$app_dir/integration"
sudo -u www-data -H bash "$scripts_dir/install.sh"
sudo -u www-data -H bash "$scripts_dir/integration-test.sh"
