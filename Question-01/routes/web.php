<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

//Route::group(['middleware' => 'auth'], function () {

    Route::controller(LoginRegisterController::class)->group(function () {
        // Route::get('/register', 'register')->name('register');
        Route::post('/store', 'store')->name('store');
        Route::get('/login', 'login')->name('login');
        Route::post('/authenticate', 'authenticate')->name('authenticate');
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer', 'index')->name('customer');
    });

    Route::controller(DishController::class)->group(function () {
        Route::get('/dish', 'index')->name('dish');
        Route::get('/dish-add', 'create')->name('dish-add');
        Route::post('/dish-save', 'store')->name('dish-save');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/order', 'index')->name('order');
        Route::get('/order-list/{id}', 'tableLoad')->name('order-list');
        Route::get('/order-add', 'create')->name('order-add');
        Route::post('/order-save', 'store')->name('order-save');
        Route::get('/dish-by-type/{type}', 'dishByType')->name('dish-by-type');
        Route::get('/dish-by-name/{name}', 'dishByName')->name('dish-by-name');
        Route::get('/daily-orders', 'dailyOrdersTbl')->name('daily-orders');
        Route::get('/famous-dish', 'famousDishTbl')->name('famous-dish');
        Route::get('/famous-side-dish', 'famousSideDishTbl')->name('famous-side-dish');
        Route::get('/famous-main-side-dish', 'mainSideDishTbl')->name('famous-main-side-dish');
    });
//});
