#!/bin/sh
set -e

echo "Starting Laravel..."

# Create SQLite DB if missing
touch database/database.sqlite

# Run migrations
php artisan migrate --force

# Start PHP server
php -S 0.0.0.0:10000 -t public
