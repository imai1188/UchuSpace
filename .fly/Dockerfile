# Laravel用マルチステージビルド
FROM php:8.2-fpm AS base

# 必要なパッケージと拡張
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl

# composer インストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ作成
WORKDIR /var/www/html

# Laravel アプリをコンテナにコピー
COPY . /var/www/html

# パーミッション調整
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# nginx と php-fpm 設定のコピー
COPY .fly/nginx /etc/nginx
COPY .fly/supervisor /etc/supervisor

# エントリーポイントに supervisor を使う
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]

