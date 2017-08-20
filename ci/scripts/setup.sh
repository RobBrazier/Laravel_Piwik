#!/bin/sh
apt-get update
apt-get install bash jq sudo git unzip wget -y
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
chown -R www-data:www-data .
mkdir -p /var/www
chown -R www-data:www-data /var/www
