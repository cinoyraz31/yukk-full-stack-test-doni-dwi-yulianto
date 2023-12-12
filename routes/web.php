<?php

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

Route::get('/register', 'App\Http\Controllers\RegisterController@show')->name('register.show');
Route::post('/register', 'App\Http\Controllers\RegisterController@create')->name('register.create');
Route::get('/login', 'App\Http\Controllers\LoginController@show')->name('login.show');
Route::post('/login', 'App\Http\Controllers\LoginController@authenticate')->name('login.authenticate');

Route::middleware(['authenticateuser'])->group(function () {
    Route::get('/', "App\Http\Controllers\DashboardController@index")->name('dashboard');
    Route::get('/transactions', "App\Http\Controllers\TransactionController@show")->name('transaction.show');
    Route::post('/transactions', "App\Http\Controllers\TransactionController@create")->name('transaction.create');
    Route::get('/balance-histories', "App\Http\Controllers\BalanceHistoryController@index")->name('balancehistory.index');
    Route::get('/logout', "App\Http\Controllers\LoginController@logout")->name('logout');
    Route::get('/balance-histories/{id}', "App\Http\Controllers\BalanceHistoryController@detail")->name('balancehistory.detail');
});
