FROM php:7.2.5-fpm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ADD https://nodejs.org/dist/v12.18.1/node-v12.18.1-linux-x64.tar.xz /usr/local
RUN tar -xf /usr/local/node-v12.18.1-linux-x64.tar.xz -C /usr/local && rm -rf /usr/local/node-v12.18.1-linux-x64.tar.xz

ENV PATH=/usr/local/node-v12.18.1-linux-x64/bin:${PATH}

RUN apt-get update -y && apt-get install -y libmcrypt-dev openssl

RUN docker-php-ext-install pdo_mysql pdo mbstring

WORKDIR /joutes
COPY . /joutes

VOLUME [ "/joutes" ]

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

EXPOSE 8000