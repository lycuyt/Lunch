<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EateryController;
use App\Http\Controllers\FoodController;
use App\Models\LunchRequest;
use App\Http\Controllers\LunchRequestController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StatisticsController;

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


Route::get('/register', [UserController::class, 'showRegistrationForm']);
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'showLoginForm']);
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [UserController::class, 'showAdmin'])->name('admin');
    Route::get('/employee', [UserController::class, 'showEmployee'])->name('employee');
    Route::resource('eatery', EateryController::class);
    Route::resource('food', FoodController::class);
    Route::resource('lunch_request', LunchRequestController::class);
    Route::resource('order', OrderController::class);

    Route::get('employee/showFoods/{id}', [LunchRequestController::class, 'show'])->name('show');
    Route::get('/ordered', [UserController::class, 'showOrder'])->name('ordered');
    Route::get('/statistics', [StatisticsController::class, 'index']);

});

