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


Auth::routes();

//Route::get('/homie', 'HomeController@index')->name('home');

Route::get('/dash', 'dashboardController@Dashboard');
Route::get('/', 'dashboardController@home')->name('dashboard');
Route::get('/rev', 'revenueController@index')->name('revenue');
Route::get('/customerretention', 'customerretentionController@index')->name('customerretention');
Route::get('/customeracqusition', 'customeracqusitionController@index')->name('customeracqusition');
Route::get('/averageorder', 'averageorderController@index')->name('averageorder');
Route::get('/product', 'productController@index')->name('product');



Route::get('/transaction', 'transactionController@transaction')->name('transaction');
Route::get('/get-total-transaction' , 'transactionController@getAllMonths');
Route::get('/get-transaction-chart-data', 'transactionController@getMonthlyPostData');
Route::get('/get-transaction-chart-data/{year}', 'transactionController@getYearPostData');

Route::get('/revenue', 'revenueController@revenue');
Route::get('/get-total-revenue' , 'revenueController@getAllMonths');
Route::get('/get-revenue-chart-data', 'revenueController@getMonthlyPostData');
Route::get('/get-revenue-chart-data/{year}', 'revenueController@getYearPostData');

Route::get('/retention', 'customerretentionController@transaction');
Route::get('/get-total-retention' , 'customerretentionController@getAllMonths');
Route::get('/get-retention-chart-data', 'customerretentionController@getMonthlyPostData');
Route::get('/get-retention-chart-data/{year}', 'customerretentionController@getYearPostData');

Route::get('test/get-retention-chart-data/{month}/{year}', 'customerretentionController@getYearPostCount');

Route::get('/acqusition', 'customeracqusitionController@transaction');
Route::get('/get-total-acqusition' , 'customeracqusitionController@getAllMonths');
Route::get('/get-acqusition-chart-data', 'customeracqusitionController@getMonthlyPostData');
Route::get('/get-acqusition-chart-data/{year}', 'customeracqusitionController@getYearPostData');

Route::get('/aov', 'averageorderController@transaction');
Route::get('/get-total-aov' , 'averageorderController@getAllMonths');
Route::get('/get-aov-chart-data', 'averageorderController@getMonthlyPostData');
Route::get('/get-aov-chart-data/{year}', 'averageorderController@getYearPostData');

Route::get('/prod', 'productController@transaction');
Route::get('/get-total-product' , 'productController@getAllMonths');
Route::get('/get-product-chart-data', 'productController@getMonthlyPostData');
Route::get('/get-product-chart-data/{year}', 'productController@getYearPostData');

Route::get('/time', 'DiffTimeController@index')->name('time');

Route::get('/product_plagiat', 'plagiatController@index')->name('plagiat');
Route::get('/get-plagiat-chart-data', 'plagiatController@index');

Route::prefix('/test', function () {

});

Route::get('testing/getmonth/{year}/{month}', 'customerretentionController@getMonthlyCount');
Route::get('testing/acq/{month}', 'customeracqusitionController@getMonthlyCount');



