# Laravel Framework 11.25.0

## Preoject setup

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
```sh
php artisan db:seed
```

### Passport configure for deploying Passport
```sh
php artisan passport:keys
```

## Create the personal access client
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

## Note
1. Authorization policy adeed for edit/delete task. User can edit and delete own tasks.
2. Add postamn collection json file (Task Manager.postman_collection.json) in root directory for API calls.
3. User Registration only available from front end application