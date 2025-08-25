
FROM php:8.2-apache

RUN mkdir -p /var/www/html/uploads     && chown -R www-data:www-data /var/www/html/uploads     && chmod -R 755 /var/www/html/uploads

COPY src/ /var/www/html/
