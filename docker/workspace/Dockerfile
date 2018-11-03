FROM ubuntu:latest

MAINTAINER simon

# Set Timezone
ARG TZ=UTC
ENV TZ ${TZ}

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# software
RUN apt-get update -yqq && \
    # supervisor
    apt-get install supervisor && \
    # soft tools
    apt-get install -y php7.2-dev && \
    apt-get install -y composer && \
    # pecl extension
    pecl channel-update pecl.php.net && \
    pecl install swoole && \
    pecl install mongodb && \
    #reids needs igbinary
    pecl install igbinary && \
    pecl install redis

ARG PHP_CONFIG_PATH=/etc/php/7.2/cli/conf.d

WORKDIR PHP_CONFIG_PATH

COPY ./conf.d/*.ini PHP_CONFIG_PATH

#ARG SUPERVISOR_CONF_PATH=./supervisor/supervisord.conf



#/usr/bin/python /usr/bin/supervisord -c ./supervisor/supervisord.conf


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