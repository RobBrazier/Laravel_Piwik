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

def runHyper(category, phpVersion, uniqueIdentifier, appDir, workingDir, scriptPath, envVars) {
  return {
    def container = "$containerNamePrefix-$category-${uniqueIdentifier.replace('.', '-')}-${BUILD_NUMBER}"
    def workspace = pwd()
    def envArgument = ""
    if (!envVars.isEmpty()) {
      vars = envVars.split(",")
      for (int i = 0; i < vars.size(); i++) {
        def envVar = vars[i].trim()
        envArgument += "--env $envVar "
      }
    }
    try {
      sh "$hyper volume create --snapshot=$snapshotVolume --name $container"
      sh "$hyper run --size=s4 --name $container $envArgument --entrypoint '/bin/sh' -v $container:$appDir -w $workingDir php:${phpVersion}-alpine $scriptPath"
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
  try {
    stage('Checkout') {
      checkout scm
    }

    stage('Install') {
      script createSnapshot()
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
      withCredentials([string(credentialsId: 'SONAR_TOKEN', variable: 'SONAR_TOKEN'), string(credentialsId: 'GITHUB_TOKEN', variable: 'GITHUB_TOKEN')]) {
          script runHyper("qa", "7.1", "7.1", appDir, appDir, "./ci/qa/run.sh", "BRANCH_NAME=\"$env.BRANCH_NAME\", CHANGE_ID=\"$env.CHANGE_ID\", SONAR_TOKEN=\"$SONAR_TOKEN\", GITHUB_TOKEN=\"$GITHUB_TOKEN\"")
      }
    }
  } catch (e) {
    echo 'Failed :('
    throw e
  }
  finally {
    sh "$hyper snapshot rm $snapshotVolume || true"
    sh "$hyper volume rm $snapshotVolume || true"
  }
}
