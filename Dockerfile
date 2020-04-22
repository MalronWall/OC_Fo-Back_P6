# Development build
FROM php:7.4.3-fpm-alpine as base_php

ENV WORKPATH "/var/www/snowtricks"

## Installe toutes les dépendances nécessaires, voir si elles le sont toutes
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev postgresql-dev gnupg autoconf git zlib-dev curl go \
    && docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install intl pdo_pgsql opcache json pgsql

## Récupère le fichier php.ini que j'ai dans le dossier pour le mettre dans le container
COPY docker/php/conf/php.ini /usr/local/etc/php/php.ini

# xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Composer
ENV COMPOSER_ALLOW_SUPERUSER 1
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Blackfire (Docker approach) & Blackfire Player
RUN version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
    && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/alpine/amd64/$version \
    && mkdir -p /tmp/blackfire \
    && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp/blackfire \
    && mv /tmp/blackfire/blackfire-*.so $(php -r "echo ini_get ('extension_dir');")/blackfire.so \
    && printf "extension=blackfire.so\nblackfire.agent_socket=tcp://blackfire:8707\n" > $PHP_INI_DIR/conf.d/blackfire.ini \
    && rm -rf /tmp/blackfire /tmp/blackfire-probe.tar.gz \
    && mkdir -p /tmp/blackfire \
    && curl -A "Docker" -L https://blackfire.io/api/v1/releases/client/linux_static/amd64 | tar zxp -C /tmp/blackfire \
    && mv /tmp/blackfire/blackfire /usr/bin/blackfire \
    && rm -Rf /tmp/blackfire

RUN mkdir -p ${WORKPATH} \
    && mkdir -p \
       ${WORKPATH}/var/cache \
       ${WORKPATH}/var/logs \
       ${WORKPATH}/var/sessions \
    && chown -R www-data /tmp/ \
    && chown -R www-data ${WORKPATH}/var

WORKDIR ${WORKPATH}

COPY --chown=www-data:www-data . ./
