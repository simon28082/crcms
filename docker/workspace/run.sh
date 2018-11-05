#!/bin/bash

/usr/bin/python /usr/bin/supervisord -c /etc/supervisor/supervisord.conf &

#echo "123"

cat ${CONTAINER_CODE_PATH}/docker/workspace/crontab/schedule >> /etc/crontab

/bin/bash