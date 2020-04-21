<?php

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

Route::get('/', 'dashboardController@Dashboard');
Route::get('/navbar', 'dashboardController@home');
Route::get('/rev', 'dashboardController@revenue');


Route::get('/transaction', 'transactionController@transaction')->name('transaction');
Route::get('/get-total-transaction' , 'transactionController@getAllMonths');
Route::get('/get-post-chart-data', 'transactionController@getMonthlyPostData');
Route::get('/get-post-chart-data/{year}', 'transactionController@getYearPostData');

Route::get('/revenue', 'revenueController@revenue');
Route::get('/get-revenue-count', 'revenueController@getMonthlyPostData');
Route::get('/get-revenue-month', 'revenueController@getAllMonths');



Route::get('/transaction/{year}', 'transactionController@year');







Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
