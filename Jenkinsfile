node {
  stage('Checkout') {
    checkout scm
  }
  stage('Unit Tests') {
    steps {
      parallel {
        "PHP 5.6": {
          sh "docker-compose run php56" 
        },
        "PHP 7.0": { 
          sh "docker-compose run php70" 
        },
        "PHP 7.1": { 
          sh "docker-compose run php71" 
        }
      }
    }
  }
}
