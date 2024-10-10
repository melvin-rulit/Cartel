FROM php:8.3-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sudo \
    sqlite3 \
    libsqlite3-dev \
    mariadb-client \
    libsodium-dev \
    libc-client-dev \
    libkrb5-dev \
    && rm -rf /var/lib/apt/lists/*

# Установка расширения Imagick
#`RUN apt-get update && apt-get install -y libmagickwand-dev && \
#    pecl install imagick && \
#    docker-php-ext-enable imagick`

# Установка и включение других расширений
RUN docker-php-ext-install \
    sockets \
    pdo_mysql \
    pdo_sqlite \
    sodium \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    soap && \
    docker-php-ext-configure imap --with-kerberos --with-imap-ssl && \
    docker-php-ext-install imap

# Установка расширения Mysql
RUN docker-php-ext-install mysqli pdo_mysql

# Установка и включение расширения Redis
#RUN pecl install redis && \
#    docker-php-ext-enable redis

# Установка и включение Xdebug
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

# Конфигурация Xdebug
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.client_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.log=/var/log/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.idekey = PHPSTORM" >> /usr/local/etc/php/conf.
