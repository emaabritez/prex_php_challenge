FROM php:8.4-fpm

# instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev

# instalar extensión mysql para Laravel
RUN docker-php-ext-install pdo_mysql

# instalar composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www