FROM php:8.2-fpm

RUN apt-get update && \
    apt-get install -y --no-install-recommends libssl-dev zlib1g-dev curl git unzip libxml2-dev libpq-dev libzip-dev librabbitmq-dev && \
    pecl install apcu amqp xdebug redis && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install -j$(nproc) zip opcache intl pdo_pgsql pgsql && \
    docker-php-ext-enable apcu pdo_pgsql sodium amqp xdebug redis && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY /entrypoint.sh /

RUN chmod 777 /entrypoint.sh && chmod +x /entrypoint.sh

#ENTRYPOINT ["/entrypoint.sh"]

EXPOSE 9000