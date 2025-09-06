<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CommanController;
use App\Http\Controllers\Api\InwardController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/refresh', [AuthController::class, 'refresh']);

Route::middleware('auth:api')
     ->middleware('jwt.verify')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::controller(CommanController::class)->group(function () {
        
        Route::get('/get-orders-list','getOrders');
        Route::get('/get-order-details/{orderId}','getOrderDetails');
        Route::get('/get-supervisors', 'getSuppervisors');        

        // Route::get('/products', 'getProducts');
        // Route::get('/suppliers', 'getSuppliers');
        // Route::get('/supervisors', 'getSupervisors');
        // Route::post('/store-order', 'storeOrder');
    });
    Route::controller(InwardController::class)->group(function () {
        Route::post('/store-inward','store');
    });
});


