FROM php:7.4-fpm-alpine

RUN apk add --no-cache libmcrypt-dev openssl

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

RUN apk add --no-cache npm

RUN docker-php-ext-install pdo_mysql pdo

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /joutes

VOLUME [ "/joutes" ]
CMD /bin/sh -c "composer install --no-autoloader --no-scripts --no-plugins && composer dump-autoload --optimize && php artisan serve --host 0.0.0.0 --port 8000"

EXPOSE 8000