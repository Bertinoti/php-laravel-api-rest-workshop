FROM php:8.0.3-fpm-buster

ARG user
ARG uid

RUN docker-php-ext-install bcmath pdo_mysql
RUN apt-get update
RUN apt-get install -y git zip unzip iputils-ping nano
RUN pecl install xdebug
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user

WORKDIR /var/www
USER $user

EXPOSE 9000
