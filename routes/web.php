<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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
    return view('auth.login');
});

Route::get('/dashboard', [ProjectController::class, 'index'])->name('projects')->middleware('auth');

Route::get('/projects', [
    'uses'=>'ProjectController@index',
    'as'=>'projects.index',
    'middleware'=>'auth'
]);

Route::get('/projects/{id}', [
    'uses'=>'ProjectController@edit',
    'as'=>'projects.edit',
    'middleware'=>'auth'
]);

Route::post('/project/store', [
    'uses'=>'ProjectController@store',
    'as'=>'projects.store',
    'middleware'=>'auth'
]);

Route::post('/project/update', [
    'uses'=>'ProjectController@update',
    'as'=>'projects.update',
    'middleware'=>'auth'
]);

Route::get('/clients', [
    'uses'=>'ClientController@index',
    'as'=>'clients.index',
    'middleware'=>'auth'
]);

Route::get('/clients/create', [
    'uses'=>'ClientController@create',
    'as'=>'clients.create',
    'middleware'=>'auth'
]);

Route::post('/clients/create', [
    'uses'=>'ClientController@store',
    'as'=>'clients.store',
    'middleware'=>'auth'
]);

Route::get('/vendordetails', [
    'uses'=>'VendorDetailController@index',
    'as'=>'vendordetails.index',
    'middleware'=>'auth'
]);

Route::get('/vendordetails/create', [
    'uses'=>'VendorDetailController@create',
    'as'=>'vendordetails.create',
    'middleware'=>'auth'
]);

Route::post('/vendordetails/store', [
    'uses'=>'VendorDetailController@store',
    'as'=>'vendordetails.store',
    'middleware'=>'auth'
]);

Route::get('/vendordetails/{vendor_id}', [
    'uses'=>'VendorDetailController@edit',
    'as'=>'vendordetails.edit',
    'middleware'=>'auth'
]);

Route::post('/vendordetails/update', [
    'uses'=>'VendorDetailController@update',
    'as'=>'vendordetails.update',
    'middleware'=>'auth'
]);

Route::get('/countries', [
    'uses'=>'CountryController@index',
    'as'=>'countries.index',
    'middleware'=>'auth'
]);

Route::get('/countries/create', [
    'uses'=>'CountryController@create',
    'as'=>'countries.create',
    'middleware'=>'auth'
]);

Route::post('/countries/create', [
    'uses'=>'CountryController@store',
    'as'=>'countries.store',
    'middleware'=>'auth'
]);

Route::get('/currencies', [
    'uses'=>'CurrencyController@index',
    'as'=>'currencies.index',
    'middleware'=>'auth'
]);

Route::get('/currencies/create', [
    'uses'=>'CurrencyController@create',
    'as'=>'currencies.create',
    'middleware'=>'auth'
]);

Route::post('/currencies/create', [
    'uses'=>'CurrencyController@store',
    'as'=>'currencies.store',
    'middleware'=>'auth'
]);

Route::get('/survey-response/{urlId}/{status}', [
    'uses'=>'RedirectController@captureRedirect'
]);

Route::get('/survey/{urlId}', [
    'uses'=>'RedirectController@redirectSurvey'
]);

require __DIR__.'/auth.php';
