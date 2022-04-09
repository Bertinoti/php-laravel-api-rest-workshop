<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controllers created for the workshop
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PropertyController;
use App\Http\Controllers\API\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Register and Login API Router
|--------------------------------------------------------------------------
*/
Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);

/*
|--------------------------------------------------------------------------
| Properties CRUD API Router
|--------------------------------------------------------------------------
*/

//NO AUTHENTICATION REQUIRED FOR RETRIEVING PROPERTIES
//GET ALL THE PROPERTIES
Route::get('properties',[PropertyController::class,'index']);
//GET DATA FROM ONE SINGLE PROPERTY
Route::get('properties/{id}',[PropertyController::class,'show']);
 

//SANCTUM AUTHENTICATION REQUIRED FOR CREATING/DELETE/UPDATE PROPERTIES
Route::middleware('auth:sanctum')->group(function() {
    
    //ADD ONE PROPERTY
    Route::post('properties',[PropertyController::class,'store']);

    //DELETE PROPERTY
    Route::delete('properties/{id}',[PropertyController::class,'destroy']);

    //ADD USER TO PROPERTY
    Route::put('properties/{id}/users/{userid}',[PropertyController::class,'addUser']);

    //REMOVE USER FROM PROPERTY
    Route::delete('properties/{id}/users/{userid}',[PropertyController::class,'removeUser']);

    //UPDATE PROPERTY
    Route::put('properties',[PropertyController::class,'update']);
});

/*
|--------------------------------------------------------------------------
| USER API Router
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function() {
    
    Route::get('users', [UserController::class,'index']);
    Route::get('users/{id}', [UserController::class,'show']);
    Route::delete('users/{id}', [UserController::class,'destroy']);
    
});

