FROM devilbox/php-fpm-7.4:latest

# opcache configurations.
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="1" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="33531" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="2048" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10" \
    PHP_OPCACHE_FILE_OVERRIDE=1


# updating the S.O.
RUN apt-get update

# installing the apt-utils package.
RUN apt-get update -y && apt-get install -y --no-install-recommends apt-utils

# installing the pdf libraries.
RUN ln -s /usr/local/bin/wkhtmlto /usr/bin/wkhtmltopdf
RUN apt-get install -y xvfb libfontconfig wkhtmltopdf

# getting the dependencies
RUN apt-get install -y zlib1g-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libreadline-dev \
    libjpeg62-turbo-dev \
    libonig-dev \
    build-essential \
    libzip-dev


# updating the dependencies.
RUN apt-get update -y

# Install Dependencies
RUN ACCEPT_EULA=Y apt-get install -y \
    unixodbc \
    unixodbc-dev \
    libgss3 \
    odbcinst \
    locales \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && locale-gen

RUN ln -s /usr/lib/x86_64-linux-gnu/libsybdb.a /usr/lib/

RUN apt-get update -y \
	&& apt-get install -y libmcrypt-dev \
	&& rm -rf /var/lib/apt/lists/* \
	&& pecl install mcrypt-1.0.2 \
	&& docker-php-ext-enable mcrypt


# turning on the extensions
RUN docker-php-ext-install gd
RUN docker-php-ext-install opcache

# install mongodb library
RUN apt-get update -y
RUN apt-get -y install gcc make autoconf libc-dev pkg-config libssl-dev
RUN pecl install mongodb
RUN docker-php-ext-install bcmath
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

# Install Laravel dependencies
RUN docker-php-ext-install iconv mbstring \
    && docker-php-ext-install zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd

# enable the redis extension.
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# copying custom php.ini configurations into the container.
#COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# adding the bmacth extension for telescope watcher
RUN docker-php-ext-install bcmath

# creating the working DIR
ENV HOME=/var/www/html
WORKDIR $HOME

# setting the default user into the working dir
USER root
COPY ./ $HOME
