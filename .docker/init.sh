#!/usr/bin/env sh

set -e

which console || alias console="php app/console"

# Setup DB
#console doctrine:database:create --if-not-exists
#console doctrine:migrations:migrate --no-interaction

#if [ "$APP_RUN_MODE" != "prod" ]; then
#    console doctrine:fixtures:load --no-interaction
#fi

# Clear cache
console cache:clear --no-warmup --env=prod
console cache:clear --no-warmup --env=dev
console cache:clear --no-warmup --env=test
