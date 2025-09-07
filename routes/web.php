<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\AuthController;
// login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login_attempt');

// logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {

    Route::get('/', [CommonController::class, 'index'])->name('dashboard');

    Route::prefix('order')->group(function () {
        Route::get('/index', [OrderController::class, 'index'])->name('order.index');
        Route::get('/details/{id}', [OrderController::class, 'details'])->name('order.details');
        Route::get('/create', [OrderController::class, 'create'])->name('order.create');
        Route::post('/store', [OrderController::class, 'store'])->name('order.store');
        Route::post('/delete/{id}', [OrderController::class, 'delete'])->name('order.delete');
    });

    Route::prefix('product')->group(function () {
        Route::get('/get-products/{supplier}', [ProductController::class, 'getBySupplier'])->name('products.bySupplier');
        Route::post('/add-products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::post('/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::get('/get-category/{id}',[ProductController::class,'getCategoryFromProduct'])->name('category.byProduct');
    });

    Route::prefix('supplier')->group(function () {
        Route::post('/store', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
        Route::post('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::delete('/destroy/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
    });

    Route::prefix('grade')->group(function () {
        Route::get('/management', [GradeController::class, 'index'])->name('grade.index');
        Route::post('/grade-add', [GradeController::class, 'store'])->name('grade.store');
        Route::post('/grade-delete', [GradeController::class, 'destroy'])->name('grade.delete');
        Route::post('/grade-update', [GradeController::class, 'update'])->name('grade.update');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/delete', [CategoryController::class, 'delete'])->name('category.delete');

    });

    Route::prefix('customers')->group(function () {

        Route::get('/',[CustomerController::class, 'index'])->name('customer.index');
        Route::post('/store', [CustomerController::class, 'store'])->name('customer.store');
        Route::post('/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
        Route::post('/destroy/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
        
        
    });
});

