<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('project/{project_id}', 'ProjectController@getProjectDetails');
Route::post('project/updateStatus/{project_id}', 'ProjectController@updateProjectStatus');
Route::post('country/add', 'CountryController@addCountries');
Route::post('currency/add', 'CurrencyController@addCurrencies');

Route::get('vendor/{vendordetail_id}', 'VendorDetailController@getVendorDetailsById');
Route::post('vendorDetail/updateStatus/{vendordetail_id}', 'VendorDetailController@updateProjectStatus');