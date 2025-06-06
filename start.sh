#!/usr/bin/env bash

# Laravel セットアップ
./scripts/00-laravel-deploy.sh

# PHP-FPM をバックグラウンドで起動
php-fpm -D

# NGINX をフォアグラウンドで起動（Render はこれを監視）
nginx -g "daemon off;"
