FROM nginx

MAINTAINER simon

ARG RUN_CONTAINTER_MAPPING_PATH

WORKDIR ${RUN_CONTAINTER_MAPPING_PATH}

RUN chown nginx:nginx -R ${RUN_CONTAINTER_MAPPING_PATH}

#ENV x=${RUN_CONTAINTER_MAPPING_PATH}

#CMD ["nginx", "-g", "daemon off;", "-c", "/${x}/docker/nginx/nginx.conf"]
#CMD ["nginx", "-g", "daemon off;", "-c", "/$${RUN_CONTAINTER_MAPPING_PATH}/docker/nginx/nginx.conf"]

ENTRYPOINT ["nginx", "-g", "daemon off;", "-c"]

EXPOSE 80
EXPOSE 443