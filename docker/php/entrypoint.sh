#!/bin/bash
set -e

php /var/www/bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
php /var/www/bin/console messenger:consume async -vv

exec "$@"