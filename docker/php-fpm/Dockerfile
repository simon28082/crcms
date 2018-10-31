FROM php:7.2-fpm

MAINTAINER simon

RUN apt-get update -yqq && \
    pecl channel-update pecl.php.net && \
    pecl install redis && \
    pecl install mongodb && \
    docker-php-ext-enable redis mongodb

ARG LOCAL_PHP_CONF_PATH
ARG RUN_CONTAINTER_MAPPING_PATH
ARG RUN_CONTAINTER_PHP_CONF_PATH

WORKDIR "${RUN_CONTAINTER_PHP_CONF_PATH}"

COPY "${LOCAL_PHP_CONF_PATH}" "${RUN_CONTAINTER_PHP_CONF_PATH}"

WORKDIR "${RUN_CONTAINTER_MAPPING_PATH}"

EXPOSE 9000