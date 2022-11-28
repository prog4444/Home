<?php

use App\Http\Controllers\Api\ApartimentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\UserController;
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
|
*/
 
Route::post('apartments' , [ApartimentController::class ,'store']);
Route::post('apartments/{id}/photo' , [ApartimentController::class , 'storeMedia']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('/apartments' , [ApartimentController::class , 'index']);

Route::get('/apartments/{id}' , [ApartimentController::class , 'show']);

Route::middleware("auth:api")->group(function(){
    Route::get('/show', [UserController::class, 'show']);
    Route::post('update/{id}', [UserController::class, 'update']);
   
    Route::patch('apartments/{id}' , [ApartimentController::class ,'update']);
    Route::delete('apartments/{id}', [ApartimentController::class ,'destroy']);

   
    Route::delete('apartments/{id}/photo' , [ApartimentController::class , 'deleteMedia']);

});



