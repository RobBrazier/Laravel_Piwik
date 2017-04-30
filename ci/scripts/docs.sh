#!/bin/bash

/home/www-data/.composer/vendor/bin/daux generate --format=html --source=docs --destination=../docs
php sami.phar update .sami.php