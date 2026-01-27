FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libsqlite3-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_sqlite zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Install PHP deps, create sqlite DB, run migrations, fix permissions
RUN composer install --no-dev --optimize-autoloader \
 && touch database/database.sqlite \
 && php artisan migrate --force \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 10000
CMD ["sh", "start.sh"]
