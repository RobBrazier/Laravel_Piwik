env.hyper = "/var/lib/jenkins/bin/hyper"
env.containerNamePrefix = "jenkins-laravelpiwik"
env.appDir = "/usr/src/app"
env.snapshotVolume = "$containerNamePrefix-snapshot-${BUILD_NUMBER}"

def createSnapshot() {
  return {
    def container = "$snapshotVolume"
    def workspace = pwd()
    try {
      sh "$hyper volume create --name $container"
      sh "$hyper volume init $workspace:$container"
      sh "$hyper run --size=s4 --name $container --entrypoint '/bin/sh' -v $container:$appDir -w $appDir php:5.6-alpine ./ci/init/run.sh"
      sh "$hyper snapshot create --name $container -v $container"
    } finally {
      sh "$hyper rm $container || true"
    }
  }
}

def runHyper(category, phpVersion, uniqueIdentifier, appDir, workingDir, script, environment) {
  return {
    def container = "$containerNamePrefix-$category-${uniqueIdentifier.replace('.', '-')}-${BUILD_NUMBER}"
    def workspace = pwd()
    def envArgument = ""
    if (!environment.isEmpty()) {
      envArgument = "--env $environment"
    }
    try {
      sh "$hyper volume create --snapshot=$snapshotVolume --name $container"
      sh "$hyper run --size=s4 --name $container $envArgument --entrypoint '/bin/sh' -v $container:$appDir -w $workingDir php:${phpVersion}-alpine $script"
    } finally {
      sh "$hyper rm $container || true"
      sh "$hyper volume rm $container || true"
    }
  }
}

def unitTest(phpVersion) {
  return runHyper("unit", phpVersion, phpVersion, appDir, appDir, "./ci/unit/run.sh", "")
}

def integrationTest(laravelVersion) {
  return runHyper("integration", "7.1", laravelVersion, "$appDir/plugin", appDir, "./plugin/ci/integration/run.sh", "LARAVEL_VERSION=$laravelVersion")
}

node {
  properties([
    buildDiscarder(logRotator(numToKeepStr: '20')),
    disableConcurrentBuilds()
  ])
  stage('Checkout') {
    checkout scm
  }

  stage('Install') {
    return createSnapshot()
  }

  stage('Unit Tests') {
    phpVersions = ['5.6', '7.0', '7.1']
    unitTestSteps = [:]
    for (int i = 0; i < phpVersions.size(); i++) {
      def phpVersion = phpVersions.get(i)
      unitTestSteps["PHP ${phpVersion}"] = unitTest(phpVersion)
    }
    parallel unitTestSteps
  }

  stage('Integration Tests') {
    laravelVersions = ['5.1', '5.2', '5.3', '5.4']
    integrationTestSteps = [:]
    for (int i = 0; i < laravelVersions.size(); i++) {
      def laravelVersion = laravelVersions.get(i)
      integrationTestSteps["Laravel ${laravelVersion}"] = integrationTest(laravelVersion)
    }
    parallel integrationTestSteps
  }

  stage('QA') {
    return runHyper("qa", "7.1", "7.1", appDir, appDir, "./ci/qa/run.sh", "")
  }
} catch (e) {
  echo 'Failed :('
} finally {
  sh "$hyper snapshot rm $snapshotVolume || true"
  sh "$hyper volume rm $snapshotVolume || true"
}
