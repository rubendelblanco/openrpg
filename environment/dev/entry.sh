#!/usr/bin/env sh

php artisan db:migrate
php artisan db:seed
php artisan serve ${HOST}:${PORT}