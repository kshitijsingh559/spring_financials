<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Api\V1')->prefix('v1')->group(function () {
    Route::post('/create-user', 'UserController@createUser');
    Route::get('/leaderboard', 'UserController@leaderboard');
    Route::get('/users-group-by-points', 'UserController@usersGroupedByPoints');
});
