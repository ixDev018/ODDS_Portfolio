#!/bin/sh
set -e

# Configure port for Nginx (Render assigns $PORT dynamically, default 80/10000)
PORT="${PORT:-80}"
sed -i "s/__PORT__/$PORT/g" /etc/nginx/http.d/default.conf

# Ensure critical directories exist
mkdir -p /var/www/html/database
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/app/public
mkdir -p /var/www/html/storage/logs

# Initialize SQLite database if it does not exist
if [ ! -f /var/www/html/database/database.sqlite ]; then
    echo "Creating SQLite database..."
    touch /var/www/html/database/database.sqlite
fi

# Ensure permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Check APP_KEY
if [ -z "$APP_KEY" ]; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Link public storage
php artisan storage:link --force 2>/dev/null || true

# Run database migrations and seed default content
echo "Running database migrations..."
php artisan migrate --force --graceful
php artisan db:seed --force

# Cache Laravel configuration, routes, and views for production performance
echo "Caching configuration and routes..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "ODDS Portfolio is ready. Starting services..."
exec /usr/bin/supervisord -n -c /etc/supervisord.conf
