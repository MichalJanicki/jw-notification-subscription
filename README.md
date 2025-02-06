1. clone repo
2. `composer install`
2. `cp .env.example .env`
4. `php artisan sail:install - choose mysql`
5. `php artisan key:generate`
6. `./vendor/bin/sail up -d`
7. `./vendor/bin/sail artisan migrate`
7. `./vendor/bin/sail artisan db:seed`
8. go to `http://localhost/persons`
