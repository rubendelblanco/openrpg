FROM php:7.4-fpm

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
     # onigumura
     libonig-dev \ 
     wget \
     # psql
     libpq-dev \ 
     libicu-dev \
     libpng-dev \
     libzip-dev \
     zlib1g-dev \
     zip \
     unzip \
     git \
     curl \
     locales \
     vim \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN docker-php-ext-install pdo pgsql pdo_pgsql mbstring zip exif bcmath gd intl opcache

RUN pecl install xdebug && docker-php-ext-enable xdebug

EXPOSE 8000

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app