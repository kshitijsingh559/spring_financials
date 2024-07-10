## Prerequisites
Things you need on your machine to install this project

1. Composer: Composer is an application-level package manager for the PHP programming language that provides a standard format for managing dependencies of PHP software and required libraries. 

To install composer visit - https://getcomposer.org/

2. php version required is 8.2 - 8.3

## Installing
1. Go to project path

2. Run `composer update`

composer will install all dependencies and all laravel packages.

Composer should have created .env file for you where you have to set the DB credentials.

Note: If .env file is not being generated automatically, you can create it by copying .env.example

3. Run `php artisan migrate`
   
4. Run `php artisan serve` to start the application. 
Now you can see your application is running on port 8000. 

5. Run `php artisan queue:work` in a seperate tab/window to proccess the queues.

6. Run `php artisan schedule:run` in a seperate tab/window to run the schedulars.

7. Import postman collecting (SpringFinancials.postman_collection.json) for api documentation.

8. Run `php artisan app:reset-all-scores` to reset all the points.
