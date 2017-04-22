#!/bin/sh
composer config repositories.piwik path ../plugin
composer config minimum-stability dev
composer update --prefer-source
composer require robbrazier/piwik:dev-master --prefer-source
sed -e 's/App\\Providers\\RouteServiceProvider::class,/App\\Providers\\RouteServiceProvider::class, RobBrazier\\Piwik\\PiwikServiceProvider::class/g' -i.bak config/app.php
sed -e 's/Illuminate\\Support\\Facades\\View::class,/Illuminate\\Support\\Facades\\View::class, "Piwik" => RobBrazier\\Piwik\\Facades\\Piwik::class/g' -i.bak config/app.php
filename="routes/web.php"
if [ "${LARAVEL_VERSION}" == "5.1" ] || [ "${LARAVEL_VERSION}" == "5.2" ]; then
    filename="app/Http/routes.php"
fi
cat $APP_DIR/../ci/scripts/routes.txt > $filename
cat $APP_DIR/../ci/scripts/config.txt > config/piwik.php
