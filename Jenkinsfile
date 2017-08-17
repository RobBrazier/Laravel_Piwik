env.hyper = "/var/lib/jenkins/bin/hyper"

def runHyper(category, phpVersion, uniqueIdentifier, appDir, workingDir, script) {
  return {
    def volume = "jenkins-laravelpiwik-$category-${uniqueIdentifier.replace('.', '-')}-${BUILD_NUMBER}"
    def workspace = pwd()
    sh "$hyper volume create --name $volume"
    sh "$hyper volume init $workspace:$volume"
    try {
      sh "$hyper run --size=s4 --name $volume --entrypoint '/bin/sh' -v $volume:$appDir -w $workingDir php:${phpVersion}-alpine $script"
    } finally {
      sh "$hyper rm $volume"
      sh "$hyper volume rm $volume"
    }
  }
}

def unitTest(phpVersion) {
  def appDir = "/usr/src/app"
  return runHyper("unit", phpVersion, phpVersion, appDir, appDir, "./ci/unit/run.sh")
}

def integrationTest(laravelVersion) {
  return runHyper("integration", "7.1", laravelVersion, "/usr/src/app/plugin", appDir, "./plugin/ci/integration/run.sh")
}

node {
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
}
