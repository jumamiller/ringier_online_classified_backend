# Welcome to Ringier Property Listing

## Installation
### Requirements
- PHP 8.1 and above
- Composer
- MySQL 5.7 and above

### Steps using PHP and MySQL
- Clone the repository
- Run `composer install`
- Create a database
- Copy `.env.example` to `.env` and update the database credentials
- Run `php artisan migrate`
- Run `php artisan db:seed`
- Run `php artisan serve`
- Visit `http://localhost:8000/api/v1/` is your base API URL

### Steps using Docker and Docker Compose
- Clone the repository
- Run `docker-compose up -d`
- Run `docker-compose exec ringier-classified-backend-app composer install`
- Run `docker-compose exec ringier-classified-backend-app php artisan key:generate`
- Run `docker-compose exec ringier-classified-backend-app php artisan config:cache`
- Run `docker-compose exec ringier-classified-backend-app php artisan db:seed`
- Run `docker-compose exec ringier-classified-backend-app php artisan storage:link`
- Run `docker-compose exec ringier-classified-backend-app php artisan passport:install`
- configure your `.env` file to use the database credentials in the `docker-compose.yml` file
- Run `docker-compose exec ringier-classified-backend-app php artisan migrate`
- Visit `http://localhost:8000/api/v1/` is your base API URL

Alternatively, you can use the Postman collection to test the API endpoints. (Find in the attached email)

## API Endpoints
Run `php artisan route:list` to see the list of API endpoints

- Alternatively, go to `routes/api.php` to see the list of API endpoints (with their respective modules)
- Open the modules to see the list of API endpoints

- Online API URLS can be found: `https://api.ringier.millerjuma.co.ke/api/v1/`
