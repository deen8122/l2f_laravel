<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\Api\AuthController;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
//Route::get('/vue', 'App\Http\Controllers\SpaController@index')->where('any', '.*');
Route::get('/', function () {
	return view('main');
});
Route::get('/about', function () {
	return view('about');
});
Route::get('/letters', function () {
	return view('letters');
});
Route::get('/l2f', function () {
	return view('l2f');
});
Route::get('/profile', function () {
	return auth()->user();
})->middleware('auth');
Route::get('/login', [AuthController::class, 'login']);
Route::get('/test', [App\Http\Controllers\TestController::class, 'userInfo']);
Route::get('/test/test', [App\Http\Controllers\TestController::class, 'test']);
Route::post('/letter/add', [LetterController::class, 'add']);
require __DIR__ . '/auth.php';


