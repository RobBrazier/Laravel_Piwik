#!/bin/sh
cd ../laravel
contents="$(jq '.repositories = [{"packagist.org": false}, {"type": "path", "url": "../src"}, {"type": "composer", "url": "https://packagist.org"}]' < composer.json)"
echo "$contents" > composer.json
composer require robbrazier/piwik:* --no-suggest --no-progress --update-no-dev
sed -e 's/App\\Providers\\RouteServiceProvider::class,/App\\Providers\\RouteServiceProvider::class, RobBrazier\\Piwik\\PiwikServiceProvider::class/g' -i.bak config/app.php
sed -e 's/Illuminate\\Support\\Facades\\View::class,/Illuminate\\Support\\Facades\\View::class, "Piwik" => RobBrazier\\Piwik\\Facades\\Piwik::class/g' -i.bak config/app.php
filename="routes/web.php"
if [ "${LARAVEL_VERSION}" = "5.1" ] || [ "${LARAVEL_VERSION}" = "5.2" ]; then
    filename="app/Http/routes.php"
fi
cat "$SCRIPTS_DIR/routes.txt" > "$filename"
cat "$SCRIPTS_DIR/config.txt" > "config/piwik.php"
