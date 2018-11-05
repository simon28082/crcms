FROM ubuntu:latest

MAINTAINER simon

# Set Timezone
ARG TZ=UTC
ENV TZ ${TZ}

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

ARG RUN_CONTAINTER_MAPPING_PATH=/var/www

# software
RUN apt-get update -yqq && \
    # supervisor
    apt-get install -y supervisor
    # soft tools
#    apt-get install -y php7.2-dev && \
#    apt-get install -y composer && \
    # pecl extension
#    pecl channel-update pecl.php.net && \
#    pecl install swoole && \
#    pecl install mongodb && \
#    #reids needs igbinary
#    pecl install igbinary && \
#    pecl install redis && \
    # mkdir
#    mkdir -p ${RUN_CONTAINTER_MAPPING_PATH}

#ARG PHP_CONFIG_PATH=/etc/php/7.2/cli/conf.d/

# copy php extension *.ini
#COPY ./conf.d ${PHP_CONFIG_PATH}

# supervisor
COPY ./supervisor /etc/supervisor
ARG SUPERVISOR_CONFIG_PATH=/etc/supervisor/supervisord.conf
#RUN /usr/bin/python /usr/bin/supervisord -c ${SUPERVISOR_CONFIG_PATH}


# user
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN groupadd -g ${PGID} crcms && \
    useradd -u ${PUID} -g crcms -m crcms && \
    usermod -p "*" crcms

EXPOSE 80
EXPOSE 443
EXPOSE 28080

#CMD ["/usr/bin/python","/usr/bin/supervisord","-c","/etc/supervisor/supervisord.conf"]
CMD []
ENTRYPOINT ["/var/www/docker/workspace/run.sh"]