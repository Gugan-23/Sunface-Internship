# Use official PHP image with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite (needed for many PHP apps)
RUN a2enmod rewrite

# Copy all project files to Apache's web root
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

