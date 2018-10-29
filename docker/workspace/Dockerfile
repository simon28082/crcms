FROM ubuntu:latest

MAINTAINER simon

RUN apt-get update -yqq && \
    pecl channel-update pecl.php.net

RUN apt-get install php7.2-cli && \
    pecl install swoole-4.2.5 && \
    apt-get install composer && \
    pecl install fileinfo


EXPOSE 80
EXPOSE 443
EXPOSE 28080