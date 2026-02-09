# Use official PHP image with Composer
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev curl

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip mbstring gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate app key
RUN php artisan key:generate

# Expose port
EXPOSE 8000

# Start the application
CMD php artisan serve --host=0.0.0.0 --port=8000