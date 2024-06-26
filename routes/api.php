<?php

use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\V1\CustomerController\Contact\ContactController;
use App\Http\Controllers\Api\V1\ManagerController\AdmissionDateController;
use App\Http\Controllers\Api\V1\ManagerController\AuthController;
use App\Http\Controllers\Api\V1\ManagerController\CountryController as ManagerControllerCountryController;
use App\Http\Controllers\Api\V1\ManagerController\CountryStepController;
use App\Http\Controllers\Api\V1\ManagerController\ExtraTutorialController;
use App\Http\Controllers\Api\V1\ManagerController\ProfileController;
use App\Http\Controllers\Api\v1\ManagerController\ServiceController;
use App\Http\Controllers\Api\V1\ManagerController\SettingController;
use App\Http\Controllers\Api\V1\ManagerController\TutorialsController;
use App\Http\Controllers\Api\V1\ManagerController\UniversityController;
use App\Http\Controllers\Api\V1\ManagerController\UniversityProgramController;
use App\Http\Controllers\Api\V1\ManagerController\UserManagerController;
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
        Route::post('/register', 'create');
        Route::post('/login', 'authentificate');
        Route::post('/forgot-password', 'forgotPassword');
        Route::post('/update-password', 'updatePassword');
        Route::get('/reset-password/{token}', function (string $token) {
            return ['token' => $token];
        })->middleware('guest')->name('password.reset');
    });

    //Country routes
    Route::controller(CountryController::class)->group(function () {
        Route::get('/countries', 'getList');
        Route::get('/cities/{idCountry}', 'getCitiesByCountry');
    });

    //Contact routes
    Route::controller(ContactController::class)->group(function () {
        Route::post('/question', 'sendEmail');
    });
});

//Manager Controllers
Route::prefix('orchid-campus/manager')->group(function () {



    //For Admin
    Route::middleware(['auth:sanctum', 'role:Admin'])->group(function () {


        //user manager
        Route::controller(UserManagerController::class)->prefix('settings')->group(function () {
            Route::get('/key/{user_name}', 'saveUserToken');
        });
    });

    //For Admin, Manager
    Route::middleware(['auth:sanctum', 'role:Admin|Manager'])->group(function () {

        //Profil
        Route::apiSingleton('profile', ProfileController::class);

         //route service
         Route::apiResource('service',ServiceController::class);
         Route::controller(ServiceController::class)->prefix('service')->group(function () {
            Route::post('/admission_dates/{serviceId}', 'saveAdmissionDate');
        });


        //setting
        Route::controller(SettingController::class)->prefix('settings')->group(function () {
            Route::post('/watermark', 'createWaterMark');
            Route::get('/watermark', 'getWatermark');
            Route::post('/sign', 'signVideo');
        });


          //University progralm
          Route::controller(UniversityProgramController::class)->prefix('university_program')->group(function () {
            Route::delete('/{university_program_id}', 'delete');
            Route::get('/prefil', 'preFilForm');
        });

        //University routes
        Route::controller(UniversityController::class)->prefix('university')->group(function () {
            Route::post('', 'save');
            Route::post('/address', 'addAddress');
            Route::post('update/{id}', 'update');
            Route::post('update-address/{university_id}', 'updateAddress');

            Route::get('{universityId}/programs-date/{year?}', 'getProgramAndAdmissionDateById');
            Route::get('/list/country/{idCountry}', 'getUniversitiesByCountryId');
            Route::get('/{id}', 'show');

            //Program
            Route::match(['post','put'],'/{university_id}/add-or-edit-program', 'addOrUpdateProgram');
            Route::get('/{university_id}/programs', 'getPrograms');
        });

        //Manager country routes
        Route::controller(ManagerControllerCountryController::class)->group(function () {
            Route::get('/countries-universities', 'getCountriesWithUniversities');
            Route::get('/countries', 'getCountriesWhereStep');
        });

        //Country routes
        Route::controller(CountryStepController::class)->group(function () {
            Route::get('/country-to-add-tuto', 'getCountryToAddTuto');
            Route::post('/country-steps', 'store');
            Route::get('/country-steps', 'getAll');
            Route::get('/country/Steps/{id}', 'findByCountry');
            Route::post('/country/steps/edit/{id}', 'editStep');
            Route::delete('/country-steps/delete/{id}', 'deleteStep');
        });

        //Country turorial
        Route::controller(TutorialsController::class)->prefix('tutorial')->group(function () {
            Route::get('/countries', 'getFlagUrlAndNameOfCountriesWithSteps');
            Route::get('/country/{id}', 'getCountryStepsByCountryId');
            Route::post('/save', 'save');
            Route::get('/step-country/{id}', 'getTutosByStepCoutryId');
            Route::post('/', 'edit');
            Route::delete('/{id}', 'deleteTutoAndReorderOrder');

           //video tuto
           Route::post('/add-tuto-video/', 'addTutoVideo');

        });

        //Extra tutoriel routes
        Route::controller(ExtraTutorialController::class)->prefix("tutorial-video")->group(function(){
            Route::delete('/{id}/{videoId}', 'delete');
        });

        //Admission date routes
        Route::controller(AdmissionDateController::class)->prefix("admission")->group(function(){
            Route::post('/', 'store');
        });

    });

    //auth
    Route::controller(AuthController::class)->group(function () {
        Route::post('/create-user', 'saveUser');
        Route::post('/login', 'authentication');
        Route::post('/forgot-password', 'forgotPassword');
        Route::post('/reset-password', 'updatePassword');
        Route::get('/logout', 'logout');
    });

});

/*

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
return $request->user();
});*/
