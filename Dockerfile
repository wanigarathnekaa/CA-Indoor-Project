FROM php:7.4-fpm

# Install any required PHP extensions here
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

# Copy your application files
COPY . /var/www

# Ensure necessary permissions
RUN chown -R www-data:www-data /var/www

CMD ["php-fpm"]
