FROM php:8.2

# Install necessary PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libxml2-dev libzip-dev libpng-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip gd

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . /var/www

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port for artisan serve
EXPOSE 9000

# Set Laravel permissions
RUN chmod -R 775 storage bootstrap/cache

# Default command: start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=9000
