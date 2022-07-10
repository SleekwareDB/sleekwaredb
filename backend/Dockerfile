# Set master image
FROM php:7.4-fpm

# Set working directory
WORKDIR /var/www/html

# Install Additional dependencies
RUN apt-get update -y \
    && apt-get upgrade -y \
    && apt-get install -y nano curl

# Install PHP Composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Remove Cache
RUN rm -rf /var/cache/apt/*

# Add UID '1000' to www-data
RUN usermod -u 1000 www-data

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html

# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
