env.hyper = "/var/lib/jenkins/bin/hyper"

def runHyper(category, phpVersion, uniqueIdentifier, appDir, workingDir, script, environment) {
  return {
    def volume = "jenkins-laravelpiwik-$category-${uniqueIdentifier.replace('.', '-')}-${BUILD_NUMBER}"
    def workspace = pwd()
    def envArgument = ""
    if (!environment.isEmpty()) {
      envArgument = "--env $environment"
    }
    sh "$hyper volume create --name $volume"
    sh "$hyper volume init $workspace:$volume"
    try {
      sh "$hyper run --size=s4 --name $volume $envArgument --entrypoint '/bin/sh' -v $volume:$appDir -w $workingDir php:${phpVersion}-alpine $script"
    } finally {
      sh "$hyper rm $volume || true"
      sh "$hyper volume rm $volume || true"
    }
  }
}

def unitTest(phpVersion) {
  def appDir = "/usr/src/app"
  return runHyper("unit", phpVersion, phpVersion, appDir, appDir, "./ci/unit/run.sh", "")
}

def integrationTest(laravelVersion) {
  def appDir = "/usr/src/app"
  return runHyper("integration", "7.1", laravelVersion, "$appDir/plugin", appDir, "./plugin/ci/integration/run.sh", "LARAVEL_VERSION=$laravelVersion")
}

node {
  properties([buildDiscarder(logRotator(numToKeepStr: '20'))])
  stage('Checkout') {
    checkout scm
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

  }
}
