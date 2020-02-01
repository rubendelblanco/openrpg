#!/usr/bin/env sh

if [ "$1" = "local" ]; then
    php artisan migrate:reset
    php artisan migrate
    php artisan db:seed
    php artisan serve --host ${HOST} --port ${PORT}
elif [ "$1" = "prod" ]; then
    php artisan serve --host ${HOST} --port ${PORT}
else
    exec $@
fi