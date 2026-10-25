FROM lscr.io/linuxserver/nginx:latest

ARG VCS_REF=unknown
LABEL org.opencontainers.image.source="https://github.com/RamonVeredic/linnms-landing-page" \
      org.opencontainers.image.revision="$VCS_REF"

# LinuxServer Nginx already includes PHP-FPM and PDO MySQL.
# Keep the application outside /config so image updates always replace its code.
COPY source/config/site/ /app/www/
COPY source/config/nginx/default.conf /etc/nginx/http.d/linms.conf
COPY source/config/php/landing.ini /etc/php85/conf.d/99-landing.ini
COPY source/config/php/zz-landing.conf /etc/php85/php-fpm.d/zz-landing.conf

EXPOSE 8080
