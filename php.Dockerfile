FROM php:8.2-alpine3.17

LABEL authors="dsorbon"

ARG USER_ID

RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

RUN apk add --no-cache zip unzip zlib-dev icu-dev g++ libzip-dev curl \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) bcmath opcache pcntl pdo_mysql mysqli intl zip \
    && docker-php-ext-enable intl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.4.4

RUN mkdir -p /var/www/html/bootstrap/cache && chmod -R 777 /var/www/html/bootstrap/cache \
  && mkdir -p /var/www/html/storage/framework/cache && chmod -R 777 /var/www/html/storage/framework/cache \
  && mkdir -p /var/www/html/storage/framework/sessions && chmod -R 777 /var/www/html/storage/framework/sessions \
  && mkdir -p /var/www/html/storage/framework/testing && chmod -R 777 /var/www/html/storage/framework/testing \
  && mkdir -p /var/www/html/storage/framework/views && chmod -R 777 /var/www/html/storage/framework/views

RUN deluser www-data
RUN adduser -D -H -u $USER_ID -s /bin/bash www-data

USER www-data
