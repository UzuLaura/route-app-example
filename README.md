How to setup App
--------------------
1. Set up your host.
2. Install composer dependencies: `composer install`.
3. Install npm dependencies `npm install`.
4. Copy `.env.example` and save as `.env`.
5. Run `php artisan key:generate`.
6. Set up your database connection, base address and default user login email and password in `.env`.
7. Run database migrations and seed `php artisan migrate:refresh --seed`.