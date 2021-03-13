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
Route::get('/projects', [ProjectController::class, 'index'])->name('projects')->middleware('auth');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->middleware('auth');

Route::post('/project/store', [
    'uses'=>'ProjectController@store',
    'as'=>'projects.store',
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

require __DIR__.'/auth.php';
