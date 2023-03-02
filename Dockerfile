FROM php:8.1-apache
RUN a2enmod rewrite
RUN apt-get update \
  && apt-get install -y libonig-dev libpq-dev zlib1g-dev libpng-dev libzip-dev libfreetype6-dev
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install zip
RUN docker-php-ext-configure gd --with-freetype
RUN docker-php-ext-install gd
ENV APACHE_DOCUMENT_ROOT=/var/www/html/web
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN find /var/www/ -type d -exec chmod 0755 {} \;
RUN find /var/www/ -type f -exec chmod 644 {} \;