<?php

use App\Http\Controllers\Api\V1\CountryController;
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

Route::prefix('orchid-campus')->group(function (){

   //User routes
    Route::post('/register',[UserController::class,'create']);

    //Country routes
    Route::controller(CountryController::class)->group(function() {
        Route::get('/countries','getList');
    });
});

/*

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
