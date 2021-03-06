FROM php:7.2-fpm-stretch

MAINTAINER Jorge Matricali <jorgematricali@gmail.com>

RUN apt-get update && \
    apt-get install -y git unzip
RUN apt-get install -y libpng-dev

RUN docker-php-ext-install -j$(nproc) pdo
RUN docker-php-ext-install -j$(nproc) pdo_mysql
RUN docker-php-ext-install -j$(nproc) bcmath
RUN docker-php-ext-install -j$(nproc) gd

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN curl -O https://codeload.github.com/phalcon/cphalcon/tar.gz/v3.4.0 && \
    tar xvzf v3.4.0 && rm v3.4.0 && \
    cd cphalcon-3.4.0/build && ./install && \
    rm -rf ~/cphalcon-3.4.0 && rm -rf ~/v3.4.0  && \
    docker-php-ext-enable phalcon

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

RUN curl -L 'https://phar.phpunit.de/phpunit-7.phar' > /usr/bin/phpunit && \
    chmod a+x /usr/bin/phpunit

# MONGO DB
RUN apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

RUN apt-get autoremove -y && \
    apt-get autoclean -y && \
    apt-get clean -y

RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*