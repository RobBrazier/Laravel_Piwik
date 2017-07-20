ARG PHP_VERSION=7.1
FROM php:$PHP_VERSION-alpine

WORKDIR /usr/src/app

COPY . .

RUN chmod +x ./ci/scripts/*.sh
RUN ./ci/scripts/setup.sh

USER www-data

RUN ./ci/scripts/install.sh

CMD [ "sh", "./ci/scripts/test.sh" ]
