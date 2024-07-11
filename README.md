## Prerequisites
Things you need on your machine to install this project

1. Composer: Composer is an application-level package manager for the PHP programming language that provides a standard format for managing dependencies of PHP software and required libraries. 

To install composer visit - https://getcomposer.org/

2. php version 8.2 or later
   
3. node version 18.17 or later 

## Run Project on your local machine
1. Go to project path

2. Run `composer update`
    composer will install all dependencies and all laravel packages.
    Composer should have created .env file for you where you have to set the DB credentials.
    Note: If .env file is not being generated automatically, you can create it by copying .env.example

3. Run `php artisan migrate`
   
4. Run `php artisan db:seed` to create some dummy records.
   
5. Run `php artisan serve` to start the application. 
    Now you can see your application is running on port 8000. 

6. Run `php artisan queue:work` in a seperate tab/window to proccess the queues.

7. Run `php artisan schedule:run` in a seperate tab/window to run the schedulars.

8. You can use `php artisan app:reset-all-scores` to reset all user's score to 0.

9. Import postman collecting (SpringFinancials.postman_collection.json) for api documentation.
   
10.  Go to `frontend` directory
    
11. copy .env.example and create .env

12. Change the value of `NEXT_PUBLIC_BASE_API_URL` as per your laravel api url eg; [127.0.0.0:8000/api/v1](http://127.0.0.1:8000/api/v1)
    
13. Run `npm install` to install node modules
    
14. Run `npm run build` to build the application
    
15. Run `npm start` to start the application
