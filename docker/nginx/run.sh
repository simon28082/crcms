#!/usr/bin/env bash

#ENTRYPOINT ["nginx", "-g", "daemon off;", "-c"]

chown ${APP_RUN_PUID}:${APP_RUN_PGID} -R ${CONTAINER_CODE_PATH}

nginx -g "daemon off;" -c ${CONTAINER_DOCKER_PATH}/nginx/nginx.conf