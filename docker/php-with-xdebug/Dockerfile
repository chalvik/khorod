FROM php:7.2-fpm

# Изменение источников на архивированные репозитории
RUN echo "deb http://archive.debian.org/debian/ buster main" > /etc/apt/sources.list && \
    echo "deb http://archive.debian.org/debian-security/ buster/updates main" >> /etc/apt/sources.list && \
    echo "Acquire::Check-Valid-Until false;" >> /etc/apt/apt.conf.d/99ignore-valid-until

# Install modules
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libicu-dev \
        libpq-dev \
        wget \
        git \
        ssh \
        ghostscript \
        libmagickwand-dev \
        jq \
        --no-install-recommends

RUN docker-php-ext-install zip intl mbstring pdo_mysql  exif \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install gd pgsql pdo_pgsql

RUN pecl install -o -f xdebug-3.1.0 \
    && docker-php-ext-enable xdebug \
    && rm -rf /tmp/pear


RUN pecl install imagick && docker-php-ext-enable imagick

COPY ./php.ini /usr/local/etc/php/
COPY ./www.conf /usr/local/etc/php/


RUN usermod -u 1000 www-data

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer --version=2.1.14 \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc && \
        composer

# Install all project dependencies
#RUN  composer global require "fxp/composer-asset-plugin:^1.4.6"
#RUN composer global require "hirak/prestissimo:^0.3.8"

RUN pecl install redis-6.0.2 \
  && echo "extension=redis.so" > /usr/local/etc/php/conf.d/ext-redis.ini

# Install libreoffice ##########################################################
RUN set -x \
    && apt-get -o Acquire::Check-Valid-Until=false -o Acquire::Check-Date=false update \
    && apt-get install -y --no-install-recommends \
       libreoffice \
    && rm -rf /var/lib/apt/lists/*
# && rm ~/.config/libreoffice/4/user/config/javasettings_Linux_X86_64.xml

# VOLUME ["/usr/local/share/fonts/"]
# /Install libreoffice #########################################################


## Install inkscape #############################################################
#COPY inkscape.key /tmp/inkscape.key
#RUN apt-get update \
#    && apt-get install software-properties-common -y \
#    && apt-key add /tmp/inkscape.key \
#    && add-apt-repository ppa:inkscape.dev/stable \
#    && apt-get update \
#    && apt-get install -y inkscape
## /Install inkscape ############################################################

# Install pdf2svg ##############################################################
RUN apt-get update \
    && apt-get install -y pdf2svg
# /Install pdf2svg #############################################################

# Install python ###############################################################
RUN apt-get update \
    && apt-get install -y python3
# /Install python ##############################################################

# Install scour ################################################################
RUN curl https://bootstrap.pypa.io/pip/3.7/get-pip.py -o get-pip.py \
    && python3 get-pip.py \
    && pip install scour
# /Install scour ###############################################################

# Fix policy for PDF export ####################################################
COPY etc/ImageMagick-6/policy.xml /etc/ImageMagick-6/policy.xml
# /Fix policy for PDF export ###################################################

WORKDIR /app

EXPOSE 9000
CMD ["php-fpm"]
