FROM ubuntu:22.04

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update
RUN apt-get install -y nano
RUN apt-get install -y php8.1
RUN apt-get install -y php8.1-fpm
RUN apt-get install -y php8.1-mbstring
RUN apt-get install -y php8.1-mysql
RUN apt-get install -y unzip
RUN apt-get install -y git
RUN apt-get install -y php8.1-curl
RUN apt-get install -y zlib1g-dev
RUN apt-get install -y libpng-dev
RUN apt-get install -y libxml2
RUN apt-get install -y libxml2-dev
RUN apt-get install -y libzip-dev
RUN apt-get install -y php8.1-gd
RUN apt-get install -y --no-install-recommends libssl-dev
RUN apt-get install -y php8.1-zip
RUN apt-get install -y php-xml
RUN apt-get install -y php-sqlite3
RUN apt-get install -y php8.1-xdebug

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

ARG MOUNT_PATH

COPY . /var/www/app
# Set working directory
WORKDIR /var/www/app

RUN composer install
RUN php artisan key:generate


CMD echo "xdebug.mode=develop,debug,coverage" >> /etc/php/8.1/cli/php.ini;\
    php artisan migrate ;\
    php artisan serve --host=0.0.0.0
