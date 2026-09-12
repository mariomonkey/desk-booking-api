FROM php:8.2-cli

# Install system dependencies & Postgres extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install PHP dependencies without dev packages
RUN composer install --no-dev --optimize-autoloader

# Set permissions for storage
RUN chmod -R 777 storage bootstrap/cache

# Expose port and start Laravel server
CMD php artisan config:clear && php artisan cache:clear && php -S 0.0.0.0:$PORT -t public
