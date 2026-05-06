FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev \
    libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Apache mod_rewrite қосу (Laravel үшін керек)
RUN a2enmod rewrite

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --prefer-dist

COPY . .

RUN composer dump-autoload --optimize --no-scripts

# Apache public/ папкасынан оқисын
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]
