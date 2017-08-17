env.hyper = "/var/lib/jenkins/bin/hyper"

def unitTest(phpVersion) {
  return {
    def volume = "jenkins-laravelpiwik-unit-${phpVersion}-${BUILD_NUMBER}"
    def workspace = pwd()
    sh "$hyper volume create --name $volume"
    sh "$hyper volume init $workspace:$volume"
    try {
      sh "$hyper run --size=s4 --name $volume --entrypoint '/bin/sh' -v $volume:/usr/src/app -w /usr/src/app php:${phpVersion}-alpine ./ci/unit/run.sh"
    } finally {
      sh "$hyper rm $volume"
      sh "$hyper volume rm $volume"
    }
  }
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
    parallel "Laravel 5.1": {
      sh "docker-compose run laravel51"
    },
    "Laravel 5.2": {
      sh "docker-compose run laravel52"
    },
    "Laravel 5.3": {
      sh "docker-compose run laravel53"
    },
    "Laravel 5.4": {
      sh "docker-compose run laravel54"
    }
  }
}
