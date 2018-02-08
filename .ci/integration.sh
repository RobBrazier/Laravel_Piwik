#!/bin/sh
. $(dirname $0)/common.sh
setup
integration_dir="/tmp/integration"
composer create-project laravel/laravel $integration_dir "${LARAVEL_VERSION}.*" --no-progress --no-dev
cd $integration_dir
# Prepare Laravel instance
contents="$(jq '.repositories = [{"packagist.org": false}, {"type": "path", "url": "../src"}, {"type": "composer", "url": "https://packagist.org"}]' < composer.json)"
echo "$contents" > composer.json
composer require robbrazier/piwik:* --no-suggest --no-progress --update-no-dev

app_config="config/app.php"
sed -r -e 's/([[:space:]]+?)(App\\Providers\\RouteServiceProvider::class,)/\1\2\n\1RobBrazier\\Piwik\\PiwikServiceProvider::class/g' \
    -e 's/([[:space:]]+?)(.*Illuminate\\Support\\Facades\\View::class,)/\1\2\n\1"Piwik" => RobBrazier\\Piwik\\Facades\\Piwik::class/g' \
    -i $app_config

routes_config="routes/web.php"
if [ "${LARAVEL_VERSION}" = "5.1" ] || [ "${LARAVEL_VERSION}" = "5.2" ]; then
    routes_config="app/Http/routes.php"
fi

# Create routes
cat <<EOT >$routes_config
<?php

Route::get("/", function() {
    return json_encode(App::make('piwik')->getReferrers()->getKeywords());
});
EOT

# Configure plugin
piwik_config="config/piwik.php"
cp "$SRC_DIR/src/config/config.php" $piwik_config
sed -r -e "s@('piwik_url').*@\1 => 'https://demo.piwik.org',@g" \
    -e "s@('api_key').*@\1 => 'anonymous',@g" \
    -e "s@('site_id').*@\1 => '7',@g" \
    -i $piwik_config

# Run test (nasty, but works...)
php -S localhost:8000 server.php &
sleep 2
output_file="/tmp/output"
curl --silent --output $output_file http://localhost:8000 
pkill -9 php
if test $(grep -c nb_uniq_visitors $output_file) -gt 0; then
    echo "valid result"
    exit 0
else
    echo "invalid result"
    cat $output_file
    exit 1
fi