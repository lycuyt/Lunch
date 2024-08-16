<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\DashBoardController;
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

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [StatisticsController::class, 'index'])->name('admin');
    Route::resource('eatery', EateryController::class); 
    Route::resource('food', FoodController::class);
    Route::resource('lunch_request', LunchRequestController::class);
    Route::get('/statistics', [StatisticsController::class, 'index']);

    Route::get('/lunch_request/{id}', 'LunchRequestController@show')->name('lunch_request.show');   
    Route::put('/lunch_request/{id}/update-status', [LunchRequestController::class, 'updateStatus'])->name('lunch_request.update_status');

});

Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/employee', [UserController::class, 'showEmployee'])->name('employee');
    Route::resource('order', OrderController::class);
    // Route::get('/ordered', [UserController::class, 'showOrder'])->name('ordered');
    // Route::get('/get-lunch-requests', [LunchRequestController::class, 'getLunchRequestsByDate']);
    Route::get('/lunch-requests', [AjaxController::class, 'index']);
    Route::get('/get-lunch-requests', [AjaxController::class, 'getLunchRequests']);
    Route::post('/save-lunch-order', [AjaxController::class, 'saveLunchOrder']);
    
    Route::get('/get-order/{id}', [AjaxController::class, 'getOrder'])->name('getOrder');

    // Route để cập nhật thông tin đơn hàng
    Route::put('/update-order/{id}', [AjaxController::class, 'updateOrder'])->name('updateOrder');

    // Route để xóa đơn hàng
    Route::delete('/delete-order/{id}', [AjaxController::class, 'deleteOrder'])->name('deleteOrder');

    // Route::post('/create',[OrderController::class, 'store'])->name('order.store');
    Route:: get('/show-orders', [AjaxController::class, 'showOrders']);
});
