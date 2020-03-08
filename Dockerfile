FROM  php:7.3-fpm-alpine as php

RUN curl -sS https://getcomposer.org/installer | php && chmod +x composer.phar && mv composer.phar /usr/local/bin/composer
RUN  docker-php-ext-install pdo_mysql bcmath sockets

WORKDIR /data/avaliacao-backend/
COPY . /data/avaliacao-backend/

RUN composer install -o

RUN chmod -R 777 /data/avaliacao-backend/storage

COPY ./.docker/php-fpm/php.ini /usr/local/etc/php/php.ini
COPY ./.docker/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./.docker/php-fpm/php-fpm.conf /usr/local/etc/php-fpm.conf

FROM php as apis

EXPOSE 9000
