FROM php:8.2-apache

# Copy source files into Apache's web root
COPY . /var/www/html/

# Enable Apache mod_rewrite if needed
RUN a2enmod rewrite

EXPOSE 80
