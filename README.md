## Refactoring in Laravel

Example of refactoring in laravel 9 using things such as:
- Requests
- Actions
- ViewModels
- Model Base
- Model Builders
- Functionality test (PestPhp)
- Browser test (Laravel Dusk)

## How to install

1. Create database *refactor_crud_laavel* on your mysql server. 
2. compser install
3. npm install
4. php artisan migrate
5. php artisan db:seed
7. composer require pestphp/pest-plugin-laravel --dev (optional) 
6. php artisan dusk:install (optional)

## How to execute of server
1. php artisan run serve
2. npm run dev

## How to execute tests
1. php artisan test --filter ProjectTest
2. php artisan dusk --filter ProjectsTest

