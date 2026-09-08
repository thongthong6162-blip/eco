# FROM php:8.2-cli

# RUN apt-get update && apt-get install -y \
#     unzip \
#     git \
#     curl \
#     libsqlite3-dev \
#     libzip-dev \
#     zip \
#     && docker-php-ext-install pdo pdo_sqlite zip

# COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# WORKDIR /app
# COPY . .

# RUN composer install --no-dev --optimize-autoloader \
#  && chmod -R 775 storage bootstrap/cache

# EXPOSE 10000
# CMD ["sh", "start.sh"]

FROM php:8.2-cli
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libsqlite3-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_sqlite zip
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY . .
RUN composer install --no-dev --optimize-autoloader \
 && chmod -R 775 storage bootstrap/cache
EXPOSE 10000
CMD ["sh", "start.sh"]
