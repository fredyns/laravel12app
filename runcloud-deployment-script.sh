git reset --hard HEAD
git pull

composer dump-autoload -o

composer update
npm update

php artisan optimize:clear
php artisan livewire:publish --assets
php artisan queue:restart

npm run build

php artisan migrate
