#!/usr/bin/env bash

app_dir="/usr/src/app"
image="$1"
script="$2"
subdir="$3"
if [ "$subdir" != "" ]; then
  subdir="/$subdir"
fi
envVars=${envVars:-}
envArgs=""

for var in $envVars; do
  envArgs="-e $var $envArgs"
done

set -e -x

eval "docker run --rm -v \"$PWD:${app_dir}${subdir}\" -w $app_dir --entrypoint /bin/sh $envArgs $image $script"
