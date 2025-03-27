# first install

composer update
npm update

php artisan key:generate
php artisan storage:link

# app codes

php artisan optimize:clear
php artisan livewire:publish --assets

npm run build

# reset DB
php artisan migrate
#php artisan migrate:fresh --seed # --force
