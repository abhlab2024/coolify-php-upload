FROM php:8.1-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy app files
COPY index.php /var/www/html/

# Ensure uploads directory exists and is writable
RUN mkdir -p /var/www/html/uploads && chmod -R 777 /var/www/html/uploads

# Increase upload limits (optional; can be tuned)
RUN {     echo "file_uploads = On";     echo "memory_limit = 256M";     echo "upload_max_filesize = 64M";     echo "post_max_size = 64M";     echo "max_execution_time = 300";   } > /usr/local/etc/php/conf.d/uploads.ini
