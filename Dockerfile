FROM php:8.0-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql

COPY . .

RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000