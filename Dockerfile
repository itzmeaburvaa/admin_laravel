FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl libpng-dev libonig-dev libxml2-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip gd mbstring

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
