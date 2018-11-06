FROM nginx

MAINTAINER simon

#### user and group #############################
ARG ARG_APP_RUN_PUID=1000
ARG ARG_APP_RUN_PGID=1000
ARG ARG_APP_RUN_NAME=crcms
ARG ARG_APP_RUN_GROUP=crcms
RUN groupadd -g ${ARG_APP_RUN_PGID} ${ARG_APP_RUN_GROUP} && \
    useradd -u ${ARG_APP_RUN_PUID} -g ${ARG_APP_RUN_PGID} ${ARG_APP_RUN_NAME} && \
    usermod -s /sbin/nologin ${ARG_APP_RUN_NAME}

#### cmd #############################
CMD ["/bin/bash"]

#### workdir #############################
ARG ARG_CONTAINER_CODE_PATH=/var/www
WORKDIR ${ARG_CONTAINER_CODE_PATH}

#### expose #############################
EXPOSE 80
EXPOSE 443