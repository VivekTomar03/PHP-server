FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql zip intl \
    && a2enmod rewrite

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html/

# Install PHP dependencies
RUN cd /var/www/html/codeignitor-app && composer install --no-dev --optimize-autoloader

# Set document root to public/apps and enable rewrite
RUN sed -i 's|/var/www/html|/var/www/html/public/apps|g' /etc/apache2/sites-available/000-default.conf

# Allow .htaccess overrides
RUN echo '<Directory /var/www/html/public/apps>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

RUN mkdir -p /var/www/html/codeignitor-app/writable/cache \
    && mkdir -p /var/www/html/codeignitor-app/writable/logs \
    && mkdir -p /var/www/html/codeignitor-app/writable/session \
    && mkdir -p /var/www/html/codeignitor-app/writable/uploads \
    && chmod -R 777 /var/www/html/codeignitor-app/writable \
    && chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
