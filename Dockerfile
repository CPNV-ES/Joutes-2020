FROM php:7.4-fpm-alpine

RUN apk add --no-cache libmcrypt-dev openssl

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

RUN apk add --no-cache npm

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo_mysql pdo

WORKDIR /joutes

VOLUME [ "/joutes" ]

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

EXPOSE 8000