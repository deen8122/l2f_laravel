<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LetterController;

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
	return view('l2f');
});
//Route::get('/login', [LoginController::class, 'login']);
Route::get('/test', [App\Http\Controllers\TestController::class, 'userInfo']);
Route::get('/test/test', [App\Http\Controllers\TestController::class, 'test']);
Route::post('/letter/add', [LetterController::class, 'add']);
require __DIR__ . '/auth.php';

function l($arr) {
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

function log2file($name, $arr, $isUpdate = false) {
	ob_start();
	print_r($arr);
	if ($isUpdate) {
		$log = ob_get_contents();
		$log2 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/../storage/logs/" . $name . ".txt");
		$log2 = $log . '
			--------------
			' . $log2;
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/../storage/logs/" . $name . ".txt", $log2);
	} else {
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/../storage/logs/" . $name . ".txt", ob_get_contents());
	}
	ob_clean();
}
