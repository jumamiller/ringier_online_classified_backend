# RUN composer install.
# RUN docker compose build ringier-classified-backend-app
### key generate
sudo docker compose exec ringier-classified-backend-app php artisan key:generate

### migrate
change db host in .env file to ringier-classified-db
RUN ``bash
sudo docker compose exec ringier-classified-backend-app php artisan migrate
sudo docker compose exec ringier-classified-backend-app php artisan passport:install
``
