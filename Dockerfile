FROM php:8.3-apache

# Install required system packages and PHP extensions
RUN apt-get update && apt-get install -y \
    libxml2-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    unzip \
    git \
    && docker-php-ext-install \
    mysqli \
    curl \
    mbstring \
    xml \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html/

# Install dependencies if composer.json exists
RUN if [ -f "composer.json" ]; then composer install --no-dev --optimize-autoloader; fi

# Set appropriate permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80
