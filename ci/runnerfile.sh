#!/usr/bin/env bash

containerNamePrefix="jenkins-laravelpiwik"
appDir="/usr/src/app"
snapshotVolume="$containerNamePrefix-snapshot-$BUILD_NUMBER"
containerSize="s4"

task_dir="./ci/common"
source $task_dir/utils.sh
source $task_dir/volumes.sh
source $task_dir/container.sh

task_unitTest() {
  if [ -z "$PHP_VERSION" ]; then
    runner_log_error "PHP_VERSION environment variable is unset"
    exit 1
  fi
  containerName="$containerNamePrefix-unit-${PHP_VERSION/\./-}"
  run_container_with_snapshot_volume $containerName $appDir $appDir "robbrazier/php:$PHP_VERSION" "./ci/unit.sh"
}

task_integrationTest() {
  if [ -z "$LARAVEL_VERSION" ]; then
    runner_log_error "LARAVEL_VERSION environment variable is unset"
    exit 1
  fi
  containerName="$containerNamePrefix-integration-${LARAVEL_VERSION/\./-}"
  run_container_with_snapshot_volume $containerName "$appDir/plugin" $appDir "robbrazier/php:7.1" "./plugin/ci/integration.sh" "LARAVEL_VERSION"
}

task_qa() {
  phpVersion="7.2"
  containerName="$containerNamePrefix-qa-${phpVersion/\./-}"
  run_container_with_snapshot_volume $containerName $appDir $appDir "robbrazier/php:$phpVersion" "./ci/qa.sh" "BRANCH_NAME,PULL_REQUEST_NUMBER,SEMAPHORE_REPO_SLUG,SONAR_TOKEN,GITHUB_TOKEN"
}

task_publish_docs() {
  snapshotContainerName="$containerNamePrefix-publish-docs"
  {
    create_volume_from_snapshot $snapshotVolume $snapshotContainerName
    runner_sequence daux sami netlify
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
    run_container $containerName $volumeName $appDir $appDir "robbrazier/php:7.1" "./ci/docs/daux.sh"
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
    run_container $containerName $volumeName $appDir $appDir "robbrazier/php:7.1" "./ci/docs/sami.sh"
  } && {
    destroy_container $containerName
  } || {
    exit_code="$?"
    destroy_container $containerName
    exit $exit_code
  }
}

task_netlify() {
  if [ -z "$NETLIFY_TOKEN" ]; then
    runner_log_error "NETLIFY_TOKEN environment variable is unset"
    exit 1
  fi
  volumeName="$containerNamePrefix-publish-docs"
  containerName="$volumeName-netlify"
  {
    run_container $containerName $volumeName $appDir $appDir "node:6.11-alpine" "./ci/docs/netlify.sh" "NETLIFY_TOKEN"
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
