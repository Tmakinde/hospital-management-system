#!/bin/bash

set -ex

composer install
cat <<EOF > .env
APP_NAME=${APP_NAME:-}
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_PORT=3306
DB_HOST=${DB_HOST:-}
DB_DATABASE=${DB_DATABASE:-}
DB_USERNAME=${DB_USERNAME:-}
DB_PASSWORD=${DB_PASSWORD:-}
EOF
# # run migration
php artisan migrate
php artisan key:generate
# start php-fpm
/usr/sbin/php-fpm -D --fpm-config /etc/php-fpm.d/www.conf
#/usr/bin/supervisord -n -c /etc/supervisord.conf
exec "$@"
