FROM php:5.6-apache

# Fix debian archive mirrors for older debian releases
RUN if [ -f /etc/apt/sources.list ]; then \
        sed -i 's/deb.debian.org/archive.debian.org/g' /etc/apt/sources.list && \
        sed -i 's/security.debian.org/archive.debian.org/g' /etc/apt/sources.list && \
        sed -i '/stretch-updates/d' /etc/apt/sources.list && \
        sed -i '/jessie-updates/d' /etc/apt/sources.list ; \
    fi

RUN apt-get update && apt-get install -y --force-yes --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libxml2-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd mysqli \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install required PEAR packages
RUN pear install DB \
    && pear install HTML_Template_IT \
    && pear install HTML_QuickForm \
    && pear install Pager \
    && pear install Mail \
    && pear install Event_Dispatcher-beta

# Enable apache mod_rewrite
RUN a2enmod rewrite

WORKDIR /var/www/html
