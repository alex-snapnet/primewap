<?php

use Illuminate\Http\Request;

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


Route::resource('category','Apis\CategoryController');

Route::resource('sector','Apis\SectorController');

Route::resource('agrolytic','Apis\AgrolyticController');

Route::get('agrolytic-report/{wk}','Apis\AgrolyticController@report');

Route::get('agrolytic-visualization-data','Apis\AgrolyticController@getStatusReport');


Route::resource('groupname','Apis\GroupNameController');

Route::post('groupname-batch-create','Apis\GroupNameController@storeBulk');

Route::resource('customer','Apis\CustomerController');
Route::get('customer-field/{customer}','Apis\CustomerController@showField');

Route::resource('comment','Apis\CommentController');

Route::resource('user','Apis\UserController');
Route::post('user-change-password/{user}','Apis\UserController@changePassword');
Route::put('change-user-name/{user}','Apis\UserController@changeUserName');
Route::put('change-user-role/{user}','Apis\UserController@updateUserRole');


Route::resource('report','Apis\ReportController');


///Excel Service API Definition Here
Route::post('excel-to-json','Apis\ExcelServiceController@blobToJson');
