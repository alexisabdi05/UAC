<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/show-price', [PaymentController::class, 'showPaymentPage'])->name('payment.show');
Route::post('/payment', [PaymentController::class, 'processPayment']);
Route::post('/enter-balance', [PaymentController::class, 'enterBalance']);


Route::post('/send-friend-request/{user}', [FriendshipController::class, 'sendFriendRequest'])
    ->middleware('auth')
    ->name('sendFriendRequest');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'userHome'])->middleware('auth');


Route::get('/users/{user}', [UserController::class, 'show'])->name('user.show');


Route::get('/register', [LoginController::class, 'create']);
Route::post('/register', [LoginController::class, 'store']);
Route::post('/login', [LoginController::class, 'login']);



Route::get('/login', function(){
    return view('login');
});

Route::get('/store', function(){
    return view('store');
});

Route::get('/logout', [LoginController::class, 'logout']);

