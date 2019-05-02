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

Route::post('agrolytic/assign-to-oprep/{agrolytic}','Apis\AgrolyticController@assignToOpRep');

Route::get('agrolytic-report/{wk}','Apis\AgrolyticController@report');

Route::get('agrolytic-visualization-data','Apis\AgrolyticController@getStatusReport');


Route::resource('groupname','Apis\GroupNameController');

Route::post('groupname-batch-create','Apis\GroupNameController@storeBulk');

Route::post('agrolytic-batch-create','Apis\AgrolyticController@storeBulk');

//agrolytic-batch-create
//storeBulk

Route::resource('customer','Apis\CustomerController');
Route::get('customer-field/{customer}','Apis\CustomerController@showField');

Route::resource('comment','Apis\CommentController');

//reply
//ReplyController
Route::resource('reply','Apis\ReplyController');

Route::resource('user','Apis\UserController');
Route::post('user-change-password/{user}','Apis\UserController@changePassword');
Route::put('change-user-name/{user}','Apis\UserController@changeUserName');
Route::put('change-user-role/{user}','Apis\UserController@updateUserRole');

Route::put('change-user-theme/{user}','Apis\UserController@updateTheme');
//updateTheme

Route::resource('report','Apis\ReportController');


///Excel Service API Definition Here
Route::post('excel-to-json','Apis\ExcelServiceController@blobToJson');

//AuditTrailController
Route::resource('audit','Apis\AuditTrailController');

Route::get('audit-reverse-hunk/{auditTrail}','Apis\AuditTrailController@reverseHunk');
