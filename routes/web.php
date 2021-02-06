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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->name('login');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'login']);
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'authenticate'])->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


