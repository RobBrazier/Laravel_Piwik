#!/usr/bin/env bash

if [ -z "$CONTAINER_RUNTIME" ]; then
  CONTAINER_RUNTIME="hyper"
fi

is_docker() {
  [ "$CONTAINER_RUNTIME" == "docker" ]
}

is_hyper() {
  [ "$CONTAINER_RUNTIME" == "hyper" ]
}

skip() {
  message="$*"
  runner_log_notice "Skipping $message"
}

find_executable() {
  executable="$1"
  result="$(which $executable)"
  if [[ "$result" == "$executable not found" ]]; then
    result=""
  fi
  echo $result
}

get_env_string() {
  keys="$1" # comma-separated list of keys
  IFS=,
  array=( $keys )
  result=""
  for key in "${array[@]}"; do
    value="$(printenv $key)"
    if [ -n "$value" ]; then
      result="--env $key=$value $result"
    fi
  done
  echo $result
}

hyper() {
  if [ -z "$HYPER_EXECUTABLE" ]; then
    hyperFromPath="$(find_executable hyper)"
    if [ "$hyperFromPath" == "" ]; then
      runner_log_error "HYPER_EXECUTABLE environment variable is unset. Please set it to the location of your hyper executable"
      exit 1
    else
      export HYPER_EXECUTABLE="$hyperFromPath"
    fi
  fi
  runner_run $HYPER_EXECUTABLE $*
}

docker() {
  if [ -z "$DOCKER_EXECUTABLE" ]; then
    dockerFromPath="$(find_executable docker)"
    if [ "$dockerFromPath" == "" ]; then
      runner_log_error "DOCKER_EXECUTABLE environment variable is unset. Please set it to the location of your docker executable"
      exit 1
    else
      export DOCKER_EXECUTABLE="$dockerFromPath"
    fi
  fi
  runner_run $DOCKER_EXECUTABLE $*
}
