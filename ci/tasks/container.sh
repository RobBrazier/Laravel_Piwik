run_container() {
  name="$1"
  volumeDest="$2"
  workingDir="$3"
  image="$4"
  script="$5"
  envVars="$6"
  envString="$(get_env_string $6)"
  common_args="--name $name --entrypoint /bin/sh -w $workingDir $envString $image $script"
  if is_hyper; then
    hyper run --size $containerSize -v $name:$volumeDest $common_args
  elif is_docker; then
    docker run -v $(pwd):$volumeDest $common_args
  else
    skip "due to unknown CONTAINER_RUNTIME"
  fi
}

run_container_with_snapshot_volume() {
  name="$1"
  volumeDest="$2"
  workingDir="$3"
  image="$4"
  script="$5"
  envVars="$6"
  {
    create_volume_from_snapshot $snapshotVolume $name
    run_container $name $volumeDest $workingDir $image $script $envVars
  } && {
    destroy_container $name
    destroy_volume $name
  } || {
    destroy_container $name
    destroy_volume $name
  }
}

destroy_container() {
  name="$1"
  if is_hyper; then
    hyper rm $name || true
  elif is_docker; then
    docker rm $name || true
  else
    skip "due to unknown CONTAINER_RUNTIME"
  fi
}
