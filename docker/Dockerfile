FROM php:8.2-apache
RUN apt-get update && apt-get install -y \
                libfreetype-dev \
                libjpeg62-turbo-dev \
                libpng-dev \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN a2enmod rewrite headers

RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-install zip

COPY ./Script .

RUN chown -R www-data:www-data .

USER www-data