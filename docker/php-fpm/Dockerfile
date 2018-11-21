FROM php:7.2-fpm


MAINTAINER simon


#### user and group #############################
ARG ARG_APP_RUN_PUID=1000
ARG ARG_APP_RUN_PGID=1000
ARG ARG_APP_RUN_NAME=crcms
ARG ARG_APP_RUN_GROUP=crcms
RUN groupadd -g ${ARG_APP_RUN_PGID} ${ARG_APP_RUN_GROUP} && \
    useradd -u ${ARG_APP_RUN_PUID} -g ${ARG_APP_RUN_PGID} ${ARG_APP_RUN_NAME} && \
    usermod -s /sbin/nologin ${ARG_APP_RUN_NAME}


#### set timezone #############################
ARG ARG_TIMEZONE=UTC
RUN ln -snf /usr/share/zoneinfo/${ARG_TIMEZONE} /etc/localtime && echo ${ARG_TIMEZONE} > /etc/timezone


#### software install #############################
RUN apt-get update -yqq \
    && pecl channel-update pecl.php.net

#### php pecl #############################
# base install
#pdo_mysql,opcache
RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install opcache

# mongodb
ARG ARG_PHP_FPM_INSTALL_MONGODB=false
RUN if [ ${ARG_PHP_FPM_INSTALL_MONGODB} = true ]; then \
    pecl install mongodb \
    && docker-php-ext-enable mongodb \
;fi

# redis
ARG ARG_PHP_FPM_INSTALL_REDIS=false
RUN if [ ${ARG_PHP_FPM_INSTALL_REDIS} = true ]; then \
    pecl install redis \
    && docker-php-ext-enable redis \
;fi

# copy php.ini
ARG ARG_PHP_CONFIG_PATH=/usr/local/etc/php
ARG ARG_LOCAL_PHP_CONFIG_PATH=./conf/php.ini
COPY ${ARG_LOCAL_PHP_CONFIG_PATH} ${ARG_PHP_CONFIG_PATH}


#### workdir #############################
ARG ARG_CONTAINER_CODE_PATH=/var/www
WORKDIR ${ARG_CONTAINER_CODE_PATH}


#### expose #############################
EXPOSE 9000


#### cmd #############################
CMD ["/bin/bash"]