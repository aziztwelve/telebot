FROM php:7.3-fpm

#Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/html/

#Set working directory
WORKDIR /var/www/html

#Install dependencies
RUN apt-get update && apt-get install -y \
        build-essential \
        libzip-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
        libfreetype6 \
        libfreetype6-dev \
        locales \
        zip \
        jpegoptim optipng pngquat gifsicle \
        vim \
        unzip \
        git \
        curl

#clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

#Install extentions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl

#Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

#Copy existing application directory contents
COPY . /var/www/html

#Copy existing aplication directory permissions
COPY --chown=www:www . /var/www/html

#Change current user to www
USER www

#Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

