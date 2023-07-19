<?php

use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\V1\CustomerController\Contact\ContactController;
use App\Http\Controllers\Api\V1\ManagerController\AuthController;
use App\Http\Controllers\Api\V1\ManagerController\CountryStepController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
//CustomerController

Route::prefix('orchid-campus')->group(function () {

    //User routes
     Route::controller(UserController::class)->group(function () {
        Route::post('/register','create');
        Route::post('/login','authentificate');
        Route::post('/forgot-password','forgotPassword');
        Route::post('/update-password','updatePassword');
        Route::get('/reset-password/{token}', function (string $token) {
            return  ['token' => $token];
        })->middleware('guest')->name('password.reset');
    });

    //Country routes
    Route::controller(CountryController::class)->group(function () {
        Route::get('/countries', 'getList');
    });

    //Contact routes
    Route::controller(ContactController::class)->group(function () {
        Route::post('/question', 'sendEmail');
    });
});


//Manager Controllers

Route::prefix('orchid-campus')->group(function () {

    //Country routes
    Route::controller(CountryStepController::class)->group(function () {
        Route::get('/country-to-add-tuto', 'getCountryToAddTuto');
        Route::post('/country-steps', 'store');
        Route::get('/country-steps', 'getAll');
        Route::get('/country/Steps/{id}', 'findByCountry');
    });

    //auth
    Route::controller(AuthController::class)->prefix("manager")->group(function(){
        Route::post('/create-user', 'saveUser');
    });
});

/*

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
return $request->user();
});*/
