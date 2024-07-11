## Prerequisites
Things you need on your machine to install this project

1. Composer: Composer is an application-level package manager for the PHP programming language that provides a standard format for managing dependencies of PHP software and required libraries. 

To install composer visit - https://getcomposer.org/

2. php version 8.2 or later
   
3. node version 18.17 or later 

## Run Project on your local machine
1. Go to project path

2. Run `composer update`

3. copy .env.example to .env

4. Set the DB credentials

5. Run `php artisan key:generate`

6. Run `php artisan migrate`
   
7. Run `php artisan db:seed` to create some dummy records.
   
8. Run `php artisan serve` to start the application. 
    Now you can see your application is running on port 8000. 

9. Run `php artisan queue:work` in a seperate tab/window to proccess the queues.

10. Run `php artisan schedule:run` in a seperate tab/window to run the schedulars.

11. You can use `php artisan app:reset-all-scores` to reset all user's score to 0.

12. You can run test cases by `php artisan test`.

13. Import postman collecting (SpringFinancials.postman_collection.json) for api documentation.
   
14.  Go to `frontend` directory
    
15. copy .env.example and create .env

16. Change the value of `NEXT_PUBLIC_BASE_API_URL` as per your laravel api url eg; [127.0.0.0:8000/api/v1](http://127.0.0.1:8000/api/v1)
    
17. Run `npm install` to install node modules
    
18. Run `npm run build` to build the application
    
19. Run `npm start` to start the application
