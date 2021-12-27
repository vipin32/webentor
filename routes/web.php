<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

    $products = DB::select('select * from products');
    return view('welcome', compact('products'));
});

Auth::routes(['verify' => true]);

Route::get('/sign-in/github', [App\Http\Controllers\Auth\LoginController::class, 'github'])->name('github');
Route::get('/sign-in/github/redirect', [App\Http\Controllers\Auth\LoginController::class, 'githubRedirect'])->name('githubRedirect');

Route::get('/sign-in/google', [App\Http\Controllers\Auth\LoginController::class, 'google'])->name('google');
Route::get('/sign-in/google/redirect', [App\Http\Controllers\Auth\LoginController::class, 'googleRedirect'])->name('googleRedirect');

Route::get('razorpay-payment/{payment_amount}', [App\Http\Controllers\RazorpayPaymentController::class, 'payment'])->name('payment');
Route::post('razorpay-payment', [App\Http\Controllers\RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

