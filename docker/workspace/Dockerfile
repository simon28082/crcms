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
    && apt-get install -y composer


#### set timezone #############################
ARG ARG_TIMEZONE=UTC
RUN ln -snf /usr/share/zoneinfo/${ARG_TIMEZONE} /etc/localtime && echo ${ARG_TIMEZONE} > /etc/timezone


#### php pecl #############################
# swoole
ARG ARG_WORKSPACE_INSTALL_SWOOLE=false
RUN if [ ${ARG_WORKSPACE_INSTALL_SWOOLE} = true ]; then \
    pecl install swoole \
    && cp ./php/swoole.ini /etc \
#    && ln -s \
;fi

# mongodb
ARG ARG_WORKSPACE_INSTALL_MONGODB=false
RUN if [ ${ARG_WORKSPACE_INSTALL_MONGODB} = true ]; then \
    pecl install mongodb \
;fi

# redis
ARG ARG_WORKSPACE_INSTALL_REDIS=false
RUN if [ ${ARG_WORKSPACE_INSTALL_REDIS} = true ]; then \
    #reids needs igbinary
    pecl install igbinary \
    && pecl install redis \
;fi


#### expose #############################
EXPOSE 28080


#### workdir #############################
ARG ARG_CONTAINER_CODE_PATH=/var/www
WORKDIR ${ARG_CONTAINER_CODE_PATH}