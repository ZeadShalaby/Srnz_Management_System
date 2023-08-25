# Use the official PHP-FPM image as the base image
FROM php:8.1-fpm

LABEL authors="Zead Shalaby"

# Install required dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# Install the Composer package manager
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy Laravel project files
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader

# Generate key
RUN php artisan key:generate

# Install JavaScript dependencies
RUN npm install

# Build webpack assets
#RUN npx mix watch

# Expose port 8000 (assuming Laravel's default port)
EXPOSE 8000

# Start the PHP development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
