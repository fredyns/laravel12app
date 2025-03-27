# migrate database & run seeders
php artisan migrate:fresh --seed # --force

# start sail
./vendor/bin/sail up

# run migration on sail
./vendor/bin/sail artisan migrate
