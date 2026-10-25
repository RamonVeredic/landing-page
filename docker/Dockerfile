FROM nginx:stable-alpine

ARG VCS_REF=unknown
LABEL org.opencontainers.image.source="https://github.com/RamonVeredic/landing-page" \
      org.opencontainers.image.revision="$VCS_REF"

COPY source/config/nginx/ /workspace/landing-source/config/nginx/
COPY source/config/site/404.html /workspace/landing-source/config/site/404.html
COPY source/config/site/asset/ /workspace/landing-source/config/site/asset/

RUN rm -f /etc/nginx/nginx.conf /etc/nginx/conf.d/default.conf /usr/share/nginx/html/404.html \
    && ln -s /workspace/landing-source/config/nginx/nginx.conf /etc/nginx/nginx.conf \
    && ln -s /workspace/landing-source/config/nginx/default.conf /etc/nginx/conf.d/default.conf \
    && ln -s /workspace/landing-source/config/site/404.html /usr/share/nginx/html/404.html \
    && ln -s /workspace/landing-source/config/site/asset /usr/share/nginx/html/asset

EXPOSE 8080
ENTRYPOINT ["nginx"]
CMD ["-g", "daemon off;"]
