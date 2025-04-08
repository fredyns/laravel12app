# Use PHP with Apache as the base image
FROM php:8.2-apache

# Install required system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    zip \
    git \
    curl \
    nodejs \
    npm \
    nano

# Enable necessary PHP extensions
RUN docker-php-ext-install pdo_pgsql pgsql zip

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy the Laravel application files
COPY . .

# Set proper permissions for Laravel storage and bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Enable Apache's mod_rewrite for Laravel
RUN a2enmod rewrite

# Expose port 80 for web access
EXPOSE 80

# Start Apache when the container runs
CMD ["apache2-foreground"]
