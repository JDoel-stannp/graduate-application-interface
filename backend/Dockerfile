# backend/Dockerfile
FROM php:8.3-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . .

# Install PHP dependencies
RUN composer install --prefer-dist --no-scripts --no-interaction

# Generate application key (if not already set)
RUN php artisan key:generate --ansi

# Expose port 9000 (PHP-FPM default)
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
