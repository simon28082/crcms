FROM ubuntu:latest


MAINTAINER simon


#### user and group #############################
ARG ARG_APP_RUN_PUID=1000
ARG ARG_APP_RUN_PGID=1000
ARG ARG_APP_RUN_NAME=crcms
ARG ARG_APP_RUN_GROUP=crcms
RUN groupadd -g ${ARG_APP_RUN_PGID} ${ARG_APP_RUN_GROUP} && \
    useradd -u ${ARG_APP_RUN_PUID} -g ${ARG_APP_RUN_PGID} ${ARG_APP_RUN_NAME} && \
    usermod -s /sbin/nologin ${ARG_APP_RUN_NAME}


#### software #############################
RUN apt-get update -yqq \
    && apt-get install -y apt-utils \
    && apt-get install -y tzdata \
    && apt-get install -y cron \
    && apt-get install -y vim \
    # supervisor
    && apt-get install -y supervisor \
    # php
#    && sh -c '/bin/echo -e "6\n69" | apt-get install -yqq php7.2-dev' \
    && apt-get install -y php7.2-dev \
    && apt-get install -y php7.2-pdo-mysql \
    && apt-get install -y php7.2-mbstring \
    && apt-get install -y php7.2-curl \
    && apt-get install -y php7.2-zip \
    && apt-get install -y php7.2-gd \
    && apt-get install -y composer

# npm
RUN apt-get install curl \
    && curl -sL https://deb.nodesource.com/setup_10.x | bash - \
    && apt-get install -y nodejs \
    && apt-get install -y build-essential

# clean
RUN apt-get purge -y curl

#### set timezone #############################
ARG ARG_TIMEZONE=UTC
RUN ln -snf /usr/share/zoneinfo/${ARG_TIMEZONE} /etc/localtime && echo ${ARG_TIMEZONE} > /etc/timezone


#### php pecl #############################
ARG ARG_PHP_MODS_AVAILABLE_PATH=/etc/php/7.2/mods-available
ARG ARG_PHP_CONF_PATH=/etc/php/7.2/cli/conf.d
# swoole
ARG ARG_WORKSPACE_INSTALL_SWOOLE=false
RUN if [ ${ARG_WORKSPACE_INSTALL_SWOOLE} = true ]; then \
    pecl install swoole \
    && echo "extension=swoole.so" > ${ARG_PHP_MODS_AVAILABLE_PATH}/swoole.ini \
    && ln -s ${ARG_PHP_MODS_AVAILABLE_PATH}/swoole.ini ${ARG_PHP_CONF_PATH}/20-swoole.ini \
;fi

# mongodb
ARG ARG_WORKSPACE_INSTALL_MONGODB=false
RUN if [ ${ARG_WORKSPACE_INSTALL_MONGODB} = true ]; then \
    pecl install mongodb \
    && echo "extension=mongodb.so" > ${ARG_PHP_MODS_AVAILABLE_PATH}/mongodb.ini \
    && ln -s ${ARG_PHP_MODS_AVAILABLE_PATH}/mongodb.ini ${ARG_PHP_CONF_PATH}/20-mongodb.ini \
;fi

# redis
ARG ARG_WORKSPACE_INSTALL_REDIS=false
RUN if [ ${ARG_WORKSPACE_INSTALL_REDIS} = true ]; then \
    #reids needs igbinary
    pecl install igbinary \
    && echo "extension=igbinary.so" > ${ARG_PHP_MODS_AVAILABLE_PATH}/igbinary.ini \
    && ln -s ${ARG_PHP_MODS_AVAILABLE_PATH}/igbinary.ini ${ARG_PHP_CONF_PATH}/20-igbinary.ini \
    && pecl install redis \
    && echo "extension=redis.so" > ${ARG_PHP_MODS_AVAILABLE_PATH}/redis.ini \
    && ln -s ${ARG_PHP_MODS_AVAILABLE_PATH}/redis.ini ${ARG_PHP_CONF_PATH}/20-redis.ini \
;fi


#### expose #############################
EXPOSE 28080


#### workdir #############################
ARG ARG_CONTAINER_CODE_PATH=/var/www
WORKDIR ${ARG_CONTAINER_CODE_PATH}