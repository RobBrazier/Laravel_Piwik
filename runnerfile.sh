#!/usr/bin/env bash
cd "$(dirname "$0")" || exit
task_dir="./ci/tasks"
source $task_dir/runner.sh

containerNamePrefix="jenkins-laravelpiwik"
appDir="/usr/src/app"
snapshotVolume="$containerNamePrefix-snapshot-$BUILD_NUMBER"
containerSize="s4"

source $task_dir/utils.sh
source $task_dir/volumes.sh
source $task_dir/container.sh

task_install() {
  {
    create_volume $snapshotVolume
    init_volume $snapshotVolume
    run_container $snapshotVolume $snapshotVolume $appDir $appDir "php:5.6-alpine" "./ci/init/run.sh"
    create_snapshot $snapshotVolume
  } && {
    destroy_container $snapshotVolume
  } || {
    destroy_container $snapshotVolume
  }
}

task_unitTest() {
  if [ -z "$PHP_VERSION" ]; then
    runner_log_error "PHP_VERSION environment variable is unset"
    exit 1
  fi
  containerName="$containerNamePrefix-unit-${PHP_VERSION/\./-}"
  run_container_with_snapshot_volume $containerName $appDir $appDir "php:$PHP_VERSION-alpine" "./ci/unit/run.sh"
}

task_integrationTest() {
  if [ -z "$LARAVEL_VERSION" ]; then
    runner_log_error "LARAVEL_VERSION environment variable is unset"
    exit 1
  fi
  containerName="$containerNamePrefix-integration-${LARAVEL_VERSION/\./-}"
  run_container_with_snapshot_volume $containerName "$appDir/plugin" $appDir "php:7.1-alpine" "./plugin/ci/integration/run.sh" "LARAVEL_VERSION"
}

task_qa() {
  phpVersion="7.2-rc"
  containerName="$containerNamePrefix-qa-${phpVersion/\./-}"
  run_container_with_snapshot_volume $containerName $appDir $appDir "php:$phpVersion-alpine" "./ci/qa/run.sh" "BRANCH_NAME,CHANGE_ID,SONAR_TOKEN,GITHUB_TOKEN"
}

task_publish_docs() {
  snapshotContainerName="$containerNamePrefix-publish-docs"
  {
    create_volume_from_snapshot $snapshotVolume $snapshotContainerName
    runner_sequence daux sami
  } && {
    destroy_volume $snapshotContainerName
  } || {
    exit_code="$?"
    destroy_volume $snapshotContainerName
    exit $exit_code
  }
}

task_daux() {
  volumeName="$containerNamePrefix-publish-docs"
  containerName="$volumeName-daux"
  {
    run_container $containerName $volumeName $appDir $appDir "php:7.1-alpine" "./ci/docs/daux.sh"
  } && {
    destroy_container $containerName
  } || {
    exit_code="$?"
    destroy_container $containerName
    exit $exit_code
  }
}

task_sami() {
  volumeName="$containerNamePrefix-publish-docs"
  containerName="$volumeName-sami"
  {
    run_container $containerName $volumeName $appDir $appDir "php:7.1-alpine" "./ci/docs/sami.sh"
  } && {
    destroy_container $containerName
  } || {
    exit_code="$?"
    destroy_container $containerName
    exit $exit_code
  }
}

task_cleanup() {
  destroy_snapshot $snapshotVolume
  destroy_volume $snapshotVolume
}
