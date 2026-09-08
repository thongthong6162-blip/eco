# #!/bin/sh
# set -e

# echo "Starting Laravel..."

# # Create SQLite DB if missing
# touch database/database.sqlite

# # Run migrations
# php artisan migrate --force


# # Start PHP server
# php -S 0.0.0.0:10000 -t public

#!/bin/sh
set -e
echo "Starting Laravel..."

# Create SQLite DB if missing
touch database/database.sqlite

# Run migrations
php artisan migrate --force

# Seed only if not already seeded
if [ ! -f database/.seeded ]; then
  php artisan db:seed --force
  touch database/.seeded
fi

# Start PHP server
php -S 0.0.0.0:10000 -t public
