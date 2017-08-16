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
