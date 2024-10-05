# Laravel Framework 11.25.0

## Preoject settup

### Install composer
```sh
composer install
```

### Install necessary dependencies
```sh
npm install
```

### Add a .env file, You can copy file from .env.example and generate file .env , then update environment variables
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=admin
DB_PASSWORD=admin
```

### Database migrations
```sh
php artisan migrate:refresh
```

### Generate user and some demo data.
php artisan db:seed

### Passport configure for deploying Passport
```sh
php artisan passport:keys
```

## Create the Personal Access Client
```sh
php artisan passport:client --personal
```

### Run Project
```sh
php artisan serve
npm run dev
```

### After run databse seed command, You can login by
```sh
Email: demo@example.com
Password: password
```

## Note: User Registration only available from front end application