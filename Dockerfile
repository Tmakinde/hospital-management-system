FROM multiarch/fedora:34-x86_64 as base

RUN dnf update -y
RUN dnf -y install https://rpms.remirepo.net/fedora/remi-release-34.rpm
RUN sed -i 's/#baseurl/baseurl/g' /etc/yum.repos.d/remi* && sed -i 's/mirrorlist/#mirrorlist/g' /etc/yum.repos.d/remi*
RUN rm -frv /var/cache/dnf
RUN dnf install -y 'dnf-command(config-manager)' && dnf config-manager --set-enabled remi
RUN dnf -y install dnf-plugins-core
RUN dnf module reset php -y
RUN dnf module enable php:remi-7.4 -y


RUN dnf install -y httpd \
    composer \
    php \
    php-common \
    php-cli \
    php-zip \
    php-bcmath \
    php-cli \
    php-common \
    php-dba \
    php-dbg \
    php-enchant \
    php-fpm \
    php-gd \
    php-gmp \
    php-intl \
    php-json \
    php-ldap \
    php-mbstring \
    php-mcrypt \
    php-mysqlnd \
    php-odbc \
    php-opcache \
    php-pdo \
    php-pgsql


RUN dnf install -y supervisor
### Composer Phase
FROM base as composer-phase
ENV DIR=/app
RUN mkdir -p $DIR
COPY composer.json composer.lock artisan $DIR/
WORKDIR $DIR

RUN composer install --no-scripts --no-suggest --no-progress

FROM base
ENV APP_HOME=/var/www/hms \
    APP_USER=nobody \
    APP_GROUP=nobody

RUN mkdir -p $APP_HOME
WORKDIR $APP_HOME
COPY . $APP_HOME
COPY --from=composer-phase /app/vendor $APP_HOME/vendor

## Set up httpd
RUN sed -i 's/Listen 80/Listen 8080/g' /etc/httpd/conf/httpd.conf
COPY conf/httpd.app.conf /etc/httpd/conf.d
COPY conf/supervisor.conf /etc/supervisor.conf

RUN mkdir -p /run/php-fpm

RUN chmod +x scripts/start.sh


RUN echo 'LoadModule mpm_worker_module modules/mod_mpm_worker.so' > /etc/httpd/conf.modules.d/00-mpm.conf

RUN echo 'Mutex posixsem' >> /etc/httpd/conf/httpd.conf

RUN chown -R ${APP_USER}:${APP_GROUP} ${APP_HOME} \
    /etc/httpd \
    /run \
    /var/run/php-fpm \
    /var/log \
    /etc/php-fpm.conf \
    /etc/php-fpm.d \
    /etc/supervisord.conf

EXPOSE 9090
USER ${APP_USER}

CMD ["./scripts/start.sh", "httpd", "-DFOREGROUND"]

