# Use the official Nginx image as the base image
FROM public.ecr.aws/nginx/nginx

# Update the package lists and install required packages
RUN apt-get update && \
    apt-get install -y software-properties-common gnupg && \
    curl -fsSL https://packages.sury.org/php/apt.gpg | apt-key add - && \
    add-apt-repository "deb https://packages.sury.org/php/ $(lsb_release -cs) main" && \
    apt-get update && \
    apt-get install -y php8.2-fpm php8.2-bcmath php8.2-pdo php-mysql php8.2-dev php8.2-gd php8.2-zip php8.2-xml php8.2-curl php-mbstring libpng-dev libzip-dev zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the default Nginx configuration file and replace it with our custom configuration
COPY ./.codeBuild/.configuration/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY ./.codeBuild/.configuration/nginx/nginx.conf /etc/nginx/nginx.donf

RUN sed -i 's|user = www-data|user = nginx|g' /etc/php/8.2/fpm/pool.d/www.conf && \
    sed -i 's|group = www-data|group = nginx|g' /etc/php/8.2/fpm/pool.d/www.conf

# Set the working directory to the root of the Laravel project
WORKDIR /var/www/html

# Copy the Laravel project into the container
COPY . .

# Install Laravel dependencies
RUN composer install

# Set the ownership of the Laravel project files to the www-data user
RUN chmod -R 777 /var/www/html/storage

# Start PHP-FPM and Nginx
CMD sh -c 'service php8.2-fpm start && php artisan migrate --force && nginx -g "daemon off;"'
