create_volume() {
  name="$1"
  if is_hyper; then
    hyper volume create --name $name
  else
    skip "volume creation"
  fi
}

init_volume() {
  name="$1"
  if is_hyper; then
    hyper volume init $(pwd):$name
  else
    skip "volume initialization"
  fi
}

create_volume_from_snapshot() {
  snapshotVolume="$1"
  name="$2"
  if is_hyper; then
    hyper volume create --snapshot $snapshotVolume --name $name
  else
    skip "volume creation from snapshot"
  fi
}

create_snapshot() {
  name="$1"
  if is_hyper; then
    hyper snapshot create --name $name -v $name
  else
    skip "snapshot creation"
  fi
}

destroy_volume() {
  name="$1"
  if is_hyper; then
    hyper volume rm $name || true # fail silently
  else
    skip "volume removal"
  fi
}

destroy_snapshot() {
  name="$1"
  if is_hyper; then
    hyper snapshot rm $name || true # fail silently
  else
    skip "snapshot removal"
  fi
}
