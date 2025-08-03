<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    // Users Management
    Route::resource('users', 'App\Http\Controllers\UsersController');
    Route::post('users/delete', 'App\Http\Controllers\UsersController@delete')->name('users.delete');

    // Products Management
    Route::resource('products', 'App\Http\Controllers\ProductsController');
    Route::post('products/delete', 'App\Http\Controllers\ProductsController@delete')->name('products.delete');

    // Stock In Management
    Route::resource('stock-in', 'App\Http\Controllers\StockInController');
    Route::post('stock-in/delete', 'App\Http\Controllers\StockInController@delete')->name('stock-in.delete');

    // Stock Out Management
    Route::resource('stock-out', 'App\Http\Controllers\StockOutController');
    Route::post('stock-out/delete', 'App\Http\Controllers\StockOutController@delete')->name('stock-out.delete');

    // Reports
    Route::get('reports/monthly-stock', 'App\Http\Controllers\ReportController@monthlyStock')->name('reports.monthly-stock');
    Route::get('reports/expired-products', 'App\Http\Controllers\ReportController@expiredProducts')->name('reports.expired-products');
    Route::get('reports/stock-summary', 'App\Http\Controllers\ReportController@stockSummary')->name('reports.stock-summary');
    Route::get('reports/stock-movement', 'App\Http\Controllers\ReportController@stockMovement')->name('reports.stock-movement');
});