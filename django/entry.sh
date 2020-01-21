#!/usr/bin/env sh

set -euxo pipefail

if [ "$1" == "run" ]; then
    python /app/openrpg/manage.py runserver 0.0.0.0:${SERVER_PORT:-8000}
elif [ "$1" == "install" ]; then
    pip install -r ../requirements.lock
else
    exec $@
fi