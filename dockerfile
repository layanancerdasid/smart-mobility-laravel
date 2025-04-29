# Use the official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    git \
    unzip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql \
    && a2enmod rewrite

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy composer.json and composer.lock
COPY composer.json composer.lock /var/www/html/

# Install Composer (PHP dependency manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies via Composer
RUN composer install --no-scripts --no-autoloader

# Copy the Laravel application to the container
COPY . /var/www/html/

# Run composer again to optimize autoloader
RUN composer dump-autoload --optimize

# Set permissions for Laravel storage, bootstrap/cache, and public/build directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# Configure Apache
RUN echo "DocumentRoot /var/www/html/public" > /etc/apache2/sites-available/000-default.conf
RUN echo "<Directory /var/www/html/public>" >> /etc/apache2/sites-available/000-default.conf
RUN echo "    AllowOverride All" >> /etc/apache2/sites-available/000-default.conf
RUN echo "    Require all granted" >> /etc/apache2/sites-available/000-default.conf
RUN echo "</Directory>" >> /etc/apache2/sites-available/000-default.conf

# Expose the port the app runs on
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]