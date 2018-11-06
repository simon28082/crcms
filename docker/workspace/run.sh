#!/bin/bash

WORKSPACE_PATH="${CONTAINER_DOCKER_PATH}/workspace"

# supervisord
/usr/bin/python /usr/bin/supervisord -c ${WORKSPACE_PATH}/supervisor/supervisord.conf &

# crontab
cat ${WORKSPACE_PATH}/crontab/schedule \
| sed "1s#\${CONTAINER_CODE_PATH}#${CONTAINER_CODE_PATH}#g" \
| sed "1s#\${APP_RUN_MODE}#${APP_RUN_MODE}#g" \
| sed "2s#\${CONTAINER_DOCKER_PATH}#${CONTAINER_DOCKER_PATH}#g"  > /etc/crontab

service cron restart

chown ${APP_RUN_PUID}:${APP_RUN_PGID} -R ${CONTAINER_CODE_PATH}/../

/bin/bash