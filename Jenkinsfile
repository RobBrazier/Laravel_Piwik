env.hyper = "/var/lib/jenkins/bin/hyper"
env.containerNamePrefix = "jenkins-laravelpiwik"
env.appDir = "/usr/src/app"

def runHyper(category, phpVersion, uniqueIdentifier, appDir, workingDir, script, environment) {
  return {
    def container = "$containerNamePrefix-$category-${uniqueIdentifier.replace('.', '-')}-${BUILD_NUMBER}"
    def workspace = pwd()
    def envArgument = ""
    if (!environment.isEmpty()) {
      envArgument = "--env $environment"
    }
    try {
      sh "$hyper run --size=s4 --name $container $envArgument --entrypoint '/bin/sh' -v $workspace:$appDir -w $workingDir php:${phpVersion}-alpine $script"
    } finally {
      sh "$hyper rm -v $container || true"
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
    def workspace = pwd()
    container = "$containerNamePrefix-qa-${BUILD_NUMBER}"
    sh "$hyper volume create --name $container"
    sh "$hyper volume init $workspace:$container"
    try {
      sh "$hyper run --size=s4 --rm --entrypoint '/bin/sh' -v $container:$appDir -w $appDir php:7.1-alpine ./ci/scripts/qaInit.sh"
      sh "$hyper run --size=s4 --rm -v $container:/app robbrazier/composer-xdebug 'run-script test && cat /app/reports/tests.xml' > $workspace/junit.xml"
      junit "$workspace/junit.xml"
    } finally {
      sh "$hyper volume rm $container || true"
    }
  }
}
