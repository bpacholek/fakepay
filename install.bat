CALL composer install
CALL php bin/console doctrine:database:create
CALL php bin/console doctrine:schema:create
CALL php bin/console cache:clear
CALL yarn install
CALL yarn encore dev
ECHO Now run `symfony server:start`