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


Route::get('/auth', 'AdminController@login');
Route::post('/login', 'AdminController@getLoginCredentials');

Route::post('app/create_tag','AdminController@addTag');
Route::get('app/get_tags','AdminController@getTag');
Route::post('app/edit_tag','AdminController@edit_Tag');
Route::post('app/delete_tag','AdminController@deleteTag');

Route::post('app/upload','AdminController@upload');
Route::post('app/delete_image','AdminController@deleteImage');

Route::get('app/get_category','AdminController@getCategory');
Route::post('app/create_category','AdminController@addCategory');
Route::post('app/edit_category','AdminController@editCategory');
Route::post('app/delete_category','AdminController@deleteCategory');


//Report
Route::get('app/get_reports','ReportController@getReports');
Route::post('app/create_report','ReportController@addReport');
Route::post('app/edit_report','ReportController@edit_Report');
Route::post('app/delete_report','ReportController@deleteReport');

//Record
Route::get('app/get_records','RecordController@getRecords');
Route::post('app/create_record','RecordController@addRecord');
Route::post('app/edit_record','RecordController@edit_Record');
Route::post('app/delete_record','RecordController@deleteRecord');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/testpage','TestController@index');

// Route::get('/tags', '')
Route::any('{slug}', function(){
    return view('dashboard');
});