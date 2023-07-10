<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\JobOrderController;
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
    return redirect()->to('login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('boards', BoardController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('staffs', StaffController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('components', ComponentController::class);
    Route::resource('job-orders', JobOrderController::class);

    Route::prefix('orders')->group(function () {
        Route::put('{order}/approve', [OrderController::class, 'approve'])->name('orders.approve');
    });

    Route::prefix('/api')->group(function () {
        Route::get('products', [ApiController::class, 'products']);
        Route::get('customers/{customer}', [ApiController::class, 'findCustomerById']);
        Route::get('orders/{order}/items', [ApiController::class, 'orderItems']);
    });
});
