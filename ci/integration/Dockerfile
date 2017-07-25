FROM php:7.1-alpine

MAINTAINER Rob Brazier <github.laravelpiwik@rob.brzr.co>

ENV APP_DIR /usr/src/app
ENV SCRIPTS_DIR "$APP_DIR/../ci/scripts"

WORKDIR $APP_DIR

ARG LARAVEL_VERSION=5.4

COPY . plugin
RUN mv plugin/ci ..

RUN find "$SCRIPTS_DIR" -name "*.sh" -print0 -exec chmod +x {} \;
RUN "$SCRIPTS_DIR/setup.sh"

USER www-data

RUN "$SCRIPTS_DIR/laravel.sh"
WORKDIR $APP_DIR/integration
RUN "$SCRIPTS_DIR/integration.sh"

CMD "$SCRIPTS_DIR/integration-test.sh"