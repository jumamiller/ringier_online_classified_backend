FROM ubuntu:22.04
# Arguments defined in docker-compose.yml
ARG user
ARG uid
# Set working directory
WORKDIR /var/www/html/Projects
# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

FROM php:8.2-fpm
# Arguments defined in docker-compose.yml
ARG user
ARG uid
# Set working directory
WORKDIR /var/www/html/Projects

COPY --from=0 /var/www/html/Projects /var/www/html/Projects
# Install PHP extensions
RUN docker-php-ext-install pdo_mysql
# RUN docker-php-ext-install mbstring
RUN docker-php-ext-install exif
RUN docker-php-ext-install posix
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install bcmath

# install libzip for zip extension
RUN apt-get update && apt-get install -y libzip-dev

RUN docker-php-ext-install zip

# install gd for image manipulation
RUN apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev

RUN docker-php-ext-install gd

# install exr-intl for internationalization
RUN apt-get update && apt-get install -y libicu-dev

RUN docker-php-ext-install intl

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www/html/Projects

USER $user

# print $uid
