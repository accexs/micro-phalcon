#
# Based on official Nginx Dockerfile
#
# https://hub.docker.com/_/nginx/

FROM nginx:latest

MAINTAINER Jorge Matricali <jorgematricali@gmail.com>

COPY config/nginx.conf /etc/nginx/nginx.conf
RUN rm -fr /etc/nginx/conf.d/*

# Adding virtualhosts files
COPY config/conf.d/* /etc/nginx/conf.d/

