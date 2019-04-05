<?php

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
    return redirect('home');
});

Route::get('/logout', function () {
	\Auth::logout();
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('agrolytic', 'AgrolyticController')->middleware('auth');

Route::get('/auth/microsoft', 'MicrosoftController@redirectToProvider');
Route::get('/auth/microsoft/callback', 'MicrosoftController@callbackurl');

Route::get('/manage-category','CategoryController@index')->middleware('auth')->name('category.index');
Route::get('/manage-sector','SectorController@index')->middleware('auth')->name('sector.index');
Route::get('/manage-customer','CustomerController@index')->middleware('auth')->name('customer.index');
Route::get('/manage-group','GroupController@index')->middleware('auth')->name('group.index');
Route::get('/manage-user','UserController@index')->middleware('auth')->name('user.index');
Route::get('/manage-agrolytic','AgrolyticController@index')->middleware('auth')->name('agrolytic.index');
Route::get('/manage-comment/{agrolytic}','CommentController@index')->middleware('auth')->name('comment.manage');
Route::get('/manage-report/{agrolytic}','ReportController@index')->middleware('auth')->name('report.manage');

//CommentController


