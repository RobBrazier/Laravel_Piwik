#!/usr/bin/env bash

php -S localhost:8000 server.php &
sleep 2
result=$(curl http://localhost:8000)
pkill -9 php
echo $result
if [[ "$result" == *"nb_uniq_visitors"* ]]; then
    echo "valid result"
    exit 0
else
    exit 1
fi