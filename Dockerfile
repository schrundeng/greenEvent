# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (including PostgreSQL support)
RUN docker-php-ext-install pdo_mysql pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build assets
RUN npm ci
RUN npm run build

# Verify build directory exists
RUN ls -la /var/www/html/public/build/assets/ || echo "Build directory missing!"

# Create storage directories
RUN mkdir -p /var/www/html/storage/logs \
    /var/www/html/storage/app/public \
    /var/www/html/storage/framework/cache/data \
    /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/views \
    /var/www/html/bootstrap/cache

# Set permissions - run as www-data user
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Configure Apache
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Create .env from .env.example if .env doesn't exist
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Generate application key
RUN php artisan key:generate

# Expose port 80
EXPOSE 80

# Create startup script
RUN printf '#!/bin/bash\n\
set -e\n\
\n\
# Fix permissions at runtime\n\
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true\n\
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true\n\
\n\
# Run migrations if enabled\n\
if [ "$RUN_MIGRATIONS" = "true" ]; then\n\
  php artisan migrate --force\n\
fi\n\
\n\
# Clear all caches\n\
php artisan config:clear\n\
php artisan route:clear\n\
php artisan view:clear\n\
php artisan cache:clear\n\
\n\
# Re-cache\n\
php artisan config:cache\n\
php artisan route:cache\n\
\n\
# Start Apache\n\
exec apache2-foreground\n' > /usr/local/bin/start.sh && \
chmod +x /usr/local/bin/start.sh

# Start Apache with Laravel optimizations
CMD ["/usr/local/bin/start.sh"]
