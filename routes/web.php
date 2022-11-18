<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'register'])->name('index');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::get('/deactivate/{id}', [App\Http\Controllers\HomeController::class, 'deactivate'])->name('deactivate');
Route::get('/generate-new-link/{user_id}', [App\Http\Controllers\HomeController::class, 'generateNewLink'])->name('generate-new-link');

Route::group(['prefix' => 'bid'], function (){
    Route::get('/{user_id}', [App\Http\Controllers\BidController::class, 'random']);
    Route::get('/history/{user_id}', [App\Http\Controllers\BidController::class, 'history']);
});



Route::get('/{uri}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
