<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\UserController;


/*
 *
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
 */



Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::group(['middleware' => ['auth:sanctum']], function () {
	Route::get('/profile', [UserController::class, 'profile']);
	Route::post('/logout', [AuthController::class, 'logout']);
	
	Route::get('/letters', [LetterController::class, 'letters']);
	Route::get('/letter/count', [LetterController::class, 'count']);
	Route::post('/letter/add', [LetterController::class, 'add']);
	Route::get('/letter/{id}', [LetterController::class, 'show']);
});

/*
 *      https://laravel.demiart.ru/create-rest-api-with-authentication/
 * 
 * Ресурасы https://medium.com/@bad4iz/%D1%81%D0%BE%D0%B7%D0%B4%D0%B0%D0%BD%D0%B8%D0%B5-%D1%81%D0%BE%D0%B1%D1%81%D1%82%D0%B2%D0%B5%D0%BD%D0%BD%D0%BE%D0%B3%D0%BE-api-%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D1%84%D0%B5%D0%B9%D1%81%D0%B0-json-api-%D1%81%D1%80%D0%B5%D0%B4%D1%81%D1%82%D0%B2%D0%B0%D0%BC%D0%B8-%D1%81%D0%B0%D0%BC%D0%BE%D0%B3%D0%BE-laravel-5-5-76f4da2f5ca8
 */