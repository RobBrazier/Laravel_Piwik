node {
  stage 'Checkout'
  checkout scm

  stage 'Unit Tests'
  parallel {
    php56: { sh "docker-compose run php56" },
    php70: { sh "docker-compose run php70" },
    php71: { sh "docker-compose run php71" }
  }
}
