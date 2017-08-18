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

pipeline {
  agent any
  options {
    buildDiscarder(logRotator(numToKeepStr: '20'))
  }
  stages {
    stage('Checkout') {
      steps {
        checkout scm
      }
    }

    stage('Unit Tests') {
      steps {
        phpVersions = ['5.6', '7.0', '7.1']
        unitTestSteps = [:]
        for (int i = 0; i < phpVersions.size(); i++) {
          def phpVersion = phpVersions.get(i)
          unitTestSteps["PHP ${phpVersion}"] = unitTest(phpVersion)
        }
        parallel unitTestSteps
      }
    }

    stage('Integration Tests') {
      steps {
        laravelVersions = ['5.1', '5.2', '5.3', '5.4']
        integrationTestSteps = [:]
        for (int i = 0; i < laravelVersions.size(); i++) {
          def laravelVersion = laravelVersions.get(i)
          integrationTestSteps["Laravel ${laravelVersion}"] = integrationTest(laravelVersion)
        }
        parallel integrationTestSteps
      }
    }

    stage('QA') {
      steps {
        sh "env"
        script runHyper("qa", "7.1", "7.1", appDir, appDir, "./ci/qa/run.sh", "")
      }
    }
  }
  post {
    alway {
      echo 'Finished!'
    }
  }
}
