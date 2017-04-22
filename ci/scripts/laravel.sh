#!/bin/sh

composer create-project laravel/laravel integration "${LARAVEL_VERSION}.*" --prefer-source

#cd plugin
#git config --global user.email "php@docker"
#git config --global user.name "Docker Container"
#git init
#git add --all .
#git commit -m "Initial commit"