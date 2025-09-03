# Use an official PHP image with Apache
FROM php:apache

# Enable Apache's mod_rewrite module
RUN a2enmod rewrite

# Copy the application files to the web server's root directory
COPY . /var/www/html/

# Expose port 80 and start Apache
EXPOSE 80
