FROM php:7.4.7-fpm-alpine

RUN apk add --no-cache libmcrypt-dev openssl

RUN apk add --no-cache composer npm

RUN docker-php-ext-install pdo_mysql pdo

WORKDIR /joutes

VOLUME [ "/joutes" ]

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

EXPOSE 8000