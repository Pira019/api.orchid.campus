<?php

use App\Http\Controllers\CustomerController\Contact\ContactController;
use Illuminate\Http\Request;
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

Route::prefix('api.orchid-campus')->group(function (){

    //contact form
    Route::post('/contact-form',[ContactController::class,'ContactUs']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
