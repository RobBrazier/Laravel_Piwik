env.hyper = "/var/lib/jenkins/bin/hyper"
node {
  stage('Checkout') {
    checkout scm
  }
  stage('Unit Tests') {
    parallel "PHP 5.6": {
       sh "docker-compose run php56" 
    },
    "PHP 7.0": { 
      sh "docker-compose run php70" 
    },
    "PHP 7.1": { 
      sh "docker-compose run php71" 
    },
    "Hyper": {
      def volume = "jenkins-laravelpiwik-${BUILD_NUMBER}"
      def workspace = pwd()
      sh "$hyper volume create --name $volume"
      sh "$hyper volume init $workspace:$volume"
    }

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
