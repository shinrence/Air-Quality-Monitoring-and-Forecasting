FROM php:8.2-apache

# Install required extensions for PostgreSQL
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql

# Copy all project files to the Apache web root
COPY . /var/www/html/

# Enable Apache Rewrite Module if needed (optional)
RUN a2enmod rewrite

