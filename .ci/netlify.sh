#!/bin/sh
npm install -g netlify-cli
netlify deploy -p build -s laravel-piwik -t "$NETLIFY_TOKEN"
