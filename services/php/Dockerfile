FROM php:7.2-fpm

ENV DEBIAN_FRONTEND=noninteractive

# debian packages
RUN apt-get update && apt-get install -y --no-install-recommends \
    htop \
    wget \
    lynx \
    curl \
    mc \
    vim \
    libmcrypt-dev \
    libicu-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libjpeg-dev \
    libpng-dev \
    libxml2-dev \
    mysql-client \
    unzip \
    locales \
    tzdata \
    graphicsmagick \
    imagemagick \
    libmagickwand-dev

# locales
RUN printf 'en_GB.UTF-8 UTF-8\n' >> /etc/locale.gen \
    && printf 'en_US.UTF-8 UTF-8\n' >> /etc/locale.gen \
    && printf 'de_DE.UTF-8 UTF-8\n' >> /etc/locale.gen \
    && locale-gen

ENV LANGUAGE=de_DE.UTF-8
ENV LC_ALL=de_DE.UTF-8
ENV LC_CTYPE=UTF-8
ENV LANG=de_DE.UTF-8

# localtime
ENV TZ='Europe/Berlin'
RUN echo $TZ > /etc/timezone \
    && rm /etc/localtime \
    && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \
    && dpkg-reconfigure -f noninteractive tzdata

# php modules
RUN docker-php-ext-install -j$(nproc) \
    mysqli \
    pdo_mysql \
    intl \
    opcache \
    zip \
    exif \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# php pecl modules
RUN pecl install xdebug imagick mcrypt-1.0.1 \
    && docker-php-ext-enable xdebug imagick mcrypt

# imagemagick
RUN ln -s /usr/lib/x86_64-linux-gnu/ImageMagick-6.8.9/bin-Q16/MagickWand-config /usr/bin/

# php composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# php ioncube
RUN curl -SL http://downloads3.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz | tar xzv --directory /tmp --strip-components=1 \
    && mv /tmp/ioncube_loader_lin_7.2.so /usr/local/lib/php/extensions/no-debug-non-zts-20170718/

# replace fpm port because of xdebug port 9000
RUN sed -i 's/9000/9001/' /usr/local/etc/php-fpm.d/zz-docker.conf

# cleanup
RUN apt-get clean \
    && rm -fr /var/lib/apt/lists/* \
    && rm -fr /tmp/* \
    && rm -fr /var/tmp/*
