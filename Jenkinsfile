env.HYPER_EXECUTABLE = "/var/lib/jenkins/bin/hyper"
env.runner = "./runnerfile.sh"
def unitTest(phpVersion) {
  return {
    withEnv(["PHP_VERSION=$phpVersion"]) {
      sh "$runner unitTest"
    }
  }
}

def integrationTest(laravelVersion) {
  return {
    withEnv(["LARAVEL_VERSION=$laravelVersion"]) {
      sh "$runner integrationTest"
    }
  }
}

node {
  properties([
    buildDiscarder(logRotator(numToKeepStr: '20')),
    disableConcurrentBuilds(),
    pipelineTriggers([githubPush()])
  ])
  try {
    stage('Checkout') {
      checkout scm
    }

    stage('Install') {
      sh "$runner install"
    }

    stage('Unit Tests') {
      phpVersions = ['5.6', '7.0', '7.1', '7.2-rc']
      unitTestSteps = [:]
      for (int i = 0; i < phpVersions.size(); i++) {
        def phpVersion = phpVersions.get(i)
        unitTestSteps["PHP ${phpVersion}"] = unitTest(phpVersion)
      }
      parallel unitTestSteps
    }

    stage('Integration Tests') {
      laravelVersions = ['5.1', '5.2', '5.3', '5.4', '5.5']
      integrationTestSteps = [:]
      for (int i = 0; i < laravelVersions.size(); i++) {
        def laravelVersion = laravelVersions.get(i)
        integrationTestSteps["Laravel ${laravelVersion}"] = integrationTest(laravelVersion)
      }
      parallel integrationTestSteps
    }

    stage('QA') {
      withCredentials([string(credentialsId: 'SONAR_TOKEN', variable: 'SONAR_TOKEN'), string(credentialsId: 'GITHUB_TOKEN', variable: 'GITHUB_TOKEN')]) {
          changeId = env.CHANGE_ID
          if (changeId == null) {
            changeId = ""
          }
          sh "$runner qa"
      }
    }

    stage('Publish Docs') {
      if (env.BRANCH_NAME == "master" && env.CHANGE_ID == null) {
        deploySteps = [:]
        parallel deploySteps
      }
    }
  } finally {
    sh "$runner cleanup"
  }
}
