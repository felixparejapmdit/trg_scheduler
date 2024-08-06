# Use an official PHP runtime as a parent image
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    unzip \
    nano \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Ensure the storage and cache directories are writable
RUN mkdir -p /var/www/trg_scheduler_cloned/storage \
    && mkdir -p /var/www/trg_scheduler_cloned/bootstrap/cache \
    && chown -R www-data:www-data /var/www/trg_scheduler_cloned/storage /var/www/trg_scheduler_cloned/bootstrap/cache

# Change current user to www-data
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
