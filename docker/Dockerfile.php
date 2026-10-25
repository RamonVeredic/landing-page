FROM alpine:3.24

RUN sed -i 's#http://#https://#g' /etc/apk/repositories \
    && apk add --no-cache php85 php85-fpm php85-session php85-mbstring php85-pdo_mysql

COPY config/php/ /workspace/landing-source/config/php/
COPY config/site/ /workspace/landing-source/config/site/

RUN ln -s /workspace/landing-source/config/php/landing.ini /etc/php85/conf.d/99-landing.ini \
    && ln -s /workspace/landing-source/config/php/zz-landing.conf /etc/php85/php-fpm.d/zz-landing.conf \
    && ln -s /workspace/landing-source/config/site /app

WORKDIR /app
EXPOSE 9000
CMD ["php-fpm85", "--nodaemonize"]
