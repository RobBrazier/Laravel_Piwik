ARG PHP_VERSION=rc
FROM php:${PHP_VERSION}-alpine

MAINTAINER Rob Brazier <github.laravelpiwik@rob.brzr.co>

ENV APP_DIR /usr/src/app
ENV SCRIPTS_DIR "$APP_DIR/ci/scripts"

WORKDIR $APP_DIR

COPY . .

RUN find "$SCRIPTS_DIR" -name "*.sh" -print0 -exec chmod +x {} \;
RUN "$SCRIPTS_DIR/setup.sh"

USER www-data

RUN "$SCRIPTS_DIR/install.sh"

CMD "$SCRIPTS_DIR/test.sh"
