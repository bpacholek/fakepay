composer install
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
php bin/console cache:clear
yarn install
yarn encore dev
