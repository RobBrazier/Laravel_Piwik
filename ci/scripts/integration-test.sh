#!/bin/sh

php -S localhost:8000 server.php &
sleep 10
result=$(curl http://localhost:8000)
pkill -9 php
echo $result
if [[ "$result" == *"nb_uniq_visitors"* ]]; then
    exit 0
fi
exit 1