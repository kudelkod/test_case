FROM php:8.1-fpm

RUN apt-get update \
  && apt-get install -y \
  git \
  curl \
  libpng-dev \
  libonig-dev \
  libxml2-dev \
  zip \
  unzip \
  zlib1g-dev \
  libpq-dev \
  libzip-dev

RUN docker-php-ext-install pdo pdo_pgsql pgsql

RUN apt-get update && apt-get install -y supervisor

RUN mkdir -p "/etc/supervisor/logs"

COPY ./supervisord.conf /etc/supervisor/supervisord.conf

USER root

CMD ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisor/supervisord.conf"]