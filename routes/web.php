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

Auth::routes(['verify' => true]);

Route::get('/sign-in/github', [App\Http\Controllers\Auth\LoginController::class, 'github'])->name('github');
Route::get('/sign-in/github/redirect', [App\Http\Controllers\Auth\LoginController::class, 'githubRedirect'])->name('githubRedirect');

Route::get('/sign-in/google', [App\Http\Controllers\Auth\LoginController::class, 'google'])->name('google');
Route::get('/sign-in/google/redirect', [App\Http\Controllers\Auth\LoginController::class, 'googleRedirect'])->name('googleRedirect');




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

