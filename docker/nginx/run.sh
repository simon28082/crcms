#!/usr/bin/env bash

chown ${APP_RUN_PUID}:${APP_RUN_PGID} -R ${CONTAINER_CODE_PATH}

NGINX_RUN_CONF=${CONTAINER_DOCKER_PATH}/nginx/nginx-run.conf

cat ${CONTAINER_DOCKER_PATH}/nginx/nginx.conf \
| sed "s#\${APP_RUN_NAME}#${APP_RUN_NAME}#g" \
| sed "s#\${PHP_FPM_PORT}#${PHP_FPM_PORT}#g" \
| sed "s#\${CONTAINER_CODE_PATH}#${CONTAINER_CODE_PATH}#g" \
> ${NGINX_RUN_CONF}

nginx -g "daemon off;" -c ${NGINX_RUN_CONF}