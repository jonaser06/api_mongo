FROM php:7.2.0-apache

RUN apt-get update && \
  apt-get install -y git && \
  apt-get install -y zlib1g-dev

RUN a2enmod rewrite

RUN pecl install mongodb

RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
  php composer-setup.php && \
  mv composer.phar /usr/local/bin/composer

RUN apt-get update -y && apt-get install -y sendmail libpng-dev

RUN apt-get update && \
  apt-get install -y \
  zlib1g-dev 

RUN docker-php-ext-install mbstring

RUN docker-php-ext-install zip

RUN docker-php-ext-install gd

RUN apt-get install -y build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
  && docker-php-ext-install gd

RUN apt-get install -y libz-dev libmemcached-dev && \
  pecl install memcached && \
  docker-php-ext-enable memcached

RUN sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf

RUN docker-php-ext-install zip pdo pdo_mysql

WORKDIR /var/www