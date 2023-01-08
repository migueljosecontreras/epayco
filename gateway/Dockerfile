FROM php:8.1.9-apache

RUN apt-get update \
        && apt-get install -y \
            g++ \
            libicu-dev \
            libpq-dev \
            libzip-dev \
            zip \
            zlib1g-dev \
            libssh2-1 \
            curl \
            libcurl4-gnutls-dev \
            libfreetype6-dev \
            libjpeg62-turbo-dev \
            libjpeg-dev \
            libpng-dev \
            libbz2-dev \
            libxml2-dev \
            libldb-dev \
            nano \
            iputils-ping \
        && docker-php-ext-configure gd --with-jpeg=/usr/include --with-freetype=/usr/include \
        && docker-php-ext-install \
            intl \
            curl \
            gd \
            -j$(nproc) gd \
            gettext \
            bz2 \
            exif \
            opcache \
            zip \
            soap \
            mysqli \
            pdo_mysql \
            sockets

RUN docker-php-ext-enable pdo_mysql

WORKDIR /var/www/api

RUN apt-get update
RUN apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN service apache2 restart

COPY . .

RUN chown -R www-data:www-data /var/www
RUN chmod 755 /var/www

RUN composer install

RUN a2enmod rewrite
RUN a2enmod headers
RUN a2enmod expires
RUN a2enmod proxy_fcgi setenvif

RUN service apache2 restart

EXPOSE 8080

CMD ["/bin/bash", "-c", "php -S 0.0.0.0:8080 -t ./public"]
