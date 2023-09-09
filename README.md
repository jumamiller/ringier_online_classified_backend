# RUN composer install.
# RUN docker compose build ringier-classified-backend-app
### key generate
sudo docker compose exec ringier-classified-backend-app php artisan key:generate

