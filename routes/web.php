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
    'uses'=>'ProjectController@show',
    'as'=>'projects.edit',
    'middleware'=>'auth'
]);

Route::get('/projects/edit/{id}', [
    'uses'=>'ProjectController@edit',
    'as'=>'projects.edit',
    'middleware'=>'auth'
]);

Route::post('/project/store', [
    'uses'=>'ProjectController@store',
    'as'=>'projects.store',
    'middleware'=>'auth'
]);

Route::post('/project/existingstore', [
    'uses'=>'ProjectController@existingStore',
    'as'=>'projects.existingstore',
    'middleware'=>'auth'
]);

Route::post('/project/update', [
    'uses'=>'ProjectController@update',
    'as'=>'projects.update',
    'middleware'=>'auth'
]);

Route::post('/project/remove', [
    'uses'=>'ProjectController@remove',
    'as'=>'projects.remove',
    'middleware'=>'auth'
]);

Route::get('/clients', [
    'uses'=>'ClientController@index',
    'as'=>'clients.index',
    'middleware'=>'auth'
]);

Route::post('/clients/store', [
    'uses'=>'ClientController@store',
    'as'=>'clients.store',
    'middleware'=>'auth'
]);

Route::get('/clients/edit/{client_id}', [
    'uses'=>'ClientController@edit',
    'as'=>'clients.edit',
    'middleware'=>'auth'
]);

Route::post('/clients/update', [
    'uses'=>'ClientController@update',
    'as'=>'clients.update',
    'middleware'=>'auth'
]);

Route::post('/clients/remove', [
    'uses'=>'ClientController@remove',
    'as'=>'clients.remove',
    'middleware'=>'auth'
]);

Route::get('/managers', [
    'uses'=>'UserController@index',
    'as'=>'managers.index',
    'middleware'=>'auth'
]);

Route::post('/managers/store', [
    'uses'=>'UserController@store',
    'as'=>'managers.store',
    'middleware'=>'auth'
]);

Route::get('/managers/edit/{manager_id}', [
    'uses'=>'UserController@edit',
    'as'=>'managers.edit',
    'middleware'=>'auth'
]);

Route::post('/managers/update', [
    'uses'=>'UserController@update',
    'as'=>'managers.update',
    'middleware'=>'auth'
]);

Route::post('/managers/remove', [
    'uses'=>'UserController@remove',
    'as'=>'managers.remove',
    'middleware'=>'auth'
]);

Route::get('/vendors', [
    'uses'=>'VendorController@index',
    'as'=>'vendors.index',
    'middleware'=>'auth'
]);

Route::post('/vendors/store', [
    'uses'=>'VendorController@store',
    'as'=>'vendors.store',
    'middleware'=>'auth'
]);

Route::get('/vendors/edit/{vendor_id}', [
    'uses'=>'VendorController@edit',
    'as'=>'vendors.edit',
    'middleware'=>'auth'
]);

Route::post('/vendors/update', [
    'uses'=>'VendorController@update',
    'as'=>'vendors.update',
    'middleware'=>'auth'
]);

Route::post('/vendors/remove', [
    'uses'=>'VendorController@remove',
    'as'=>'vendors.remove',
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
    'uses'=>'VendorDetailController@show',
    'as'=>'vendordetails.show',
    'middleware'=>'auth'
]);

Route::get('/vendordetails/{vendor_id}/edit', [
    'uses'=>'VendorDetailController@edit',
    'as'=>'vendordetails.edit',
    'middleware'=>'auth'
]);

Route::post('/vendordetails/update', [
    'uses'=>'VendorDetailController@update',
    'as'=>'vendordetails.update',
    'middleware'=>'auth'
]);

Route::post('/vendordetails/remove', [
    'uses'=>'VendorDetailController@remove',
    'as'=>'vendordetails.remove',
    'middleware'=>'auth'
]);

Route::get('/getVendorsByProject/{project_id}', [
    'uses'=>'VendorDetailController@getVendorsByProject',
    'as'=>'vendordetails.getVendorsByProject',
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

Route::get('/survey-response/{urlId}', [
    'uses'=>'RedirectController@captureRedirect'
]);

Route::get('/survey/{urlId}', [
    'uses'=>'RedirectController@redirectSurvey'
]);

Route::get('/redirect', [
    'uses'=>'RedirectController@finalRedirect',
    'as'=>'projects.redirects.redirect',
    'middleware'=>'auth'
]);

Route::post('/receivedIds/store', [
    'uses'=>'ProjectController@saveReceivedIds',
    'as'=>'receivedIds.store',
    'middleware'=>'auth'
]);

Route::get('/project/test/{id}', [
    'uses'=>'ProjectController@test',
    'as'=>'project.test',
    'middleware'=>'auth'
]);

require __DIR__.'/auth.php';
