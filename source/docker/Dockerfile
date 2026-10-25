FROM nginx:stable-alpine

COPY config/nginx/ /workspace/landing-source/config/nginx/
COPY config/site/404.html /workspace/landing-source/config/site/404.html
COPY config/site/asset/ /workspace/landing-source/config/site/asset/

RUN rm -f /etc/nginx/nginx.conf /etc/nginx/conf.d/default.conf /usr/share/nginx/html/404.html \
    && ln -s /workspace/landing-source/config/nginx/nginx.conf /etc/nginx/nginx.conf \
    && ln -s /workspace/landing-source/config/nginx/default.conf /etc/nginx/conf.d/default.conf \
    && ln -s /workspace/landing-source/config/site/404.html /usr/share/nginx/html/404.html \
    && ln -s /workspace/landing-source/config/site/asset /usr/share/nginx/html/asset

EXPOSE 8080
ENTRYPOINT ["nginx"]
CMD ["-g", "daemon off;"]
