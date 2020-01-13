#!/usr/bin/env sh

php artisan migrate:reset
php artisan migrate
php artisan db:seed
php artisan serve --host ${HOST} --port ${PORT}