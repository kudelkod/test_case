FROM php:8.1-fpm

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

RUN apt-get update && apt-get install -y supervisor

RUN mkdir -p "/etc/supervisor/logs"

COPY ./supervisord.conf /etc/supervisor/supervisord.conf

USER root

CMD ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisor/supervisord.conf"]