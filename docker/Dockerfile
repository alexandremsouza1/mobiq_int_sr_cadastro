FROM php:8.1-fpm


ENV COMPOSER_ALLOW_SUPERUSER 1




# Install composer
RUN curl -sSL https://getcomposer.org/installer | php \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer


RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo_mysql
RUN apt-get update && apt-get install -y git zip unzip libcurl4-openssl-dev pkg-config libssl-dev libgd-dev

RUN docker-php-ext-install gd &&\
    docker-php-ext-enable gd

RUN docker-php-ext-install sockets


RUN pecl install mongodb \
     && docker-php-ext-enable mongodb


COPY ./docker/xdebug.ini $PHP_INI_DIR/conf.d/
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug



COPY entrypoint.sh /entrypoint.sh


# Install and configure Supervisor
RUN echo "Installing Supervisor...."
RUN whoami
RUN apt-get update && apt-get install -y supervisor
RUN mkdir -p /var/log/supervisor
RUN chmod -R 777 /var/log/supervisor
COPY docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf
COPY docker/supervisor/startup.sh /etc/startup.sh
RUN chmod +x /etc/startup.sh


CMD ["/entrypoint.sh"]