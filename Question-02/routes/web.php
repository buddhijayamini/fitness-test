<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RecordController;
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


    Route::controller(PatientController::class)->group(function () {
        Route::get('/patient', 'index')->name('patient');
    });

    Route::controller(RecordController::class)->group(function () {
        Route::get('/record', 'index')->name('record');
        Route::get('/record-list/{id}', 'tableLoad')->name('record-list');
        Route::get('/record-create', 'create')->name('record-create');
        Route::post('/record-save', 'store')->name('record-save');
        Route::get('/record-edit/{id}', 'edit')->name('record-edit');
        Route::post('/record-update', 'update')->name('record-update');

    });

    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoice', 'index')->name('invoice');
        Route::get('/daily-revenue', 'report')->name('daily-revenue');
    });
//});
