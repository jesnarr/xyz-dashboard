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


// Post
Route::post('app/create_post','PostController@add_Post');
Route::get('app/get_post', 'PostController@index');
Route::post('app/edit_post','PostController@edit_Post');
Route::post('app/delete_post','PostController@delete_Post');


// comments
Route::post('app/create_comment','CommentsController@add_Comment');
Route::get('app/get_comments', 'CommentsController@index');
Route::post('app/edit_comment','CommentsController@edit_Comment');
Route::post('app/delete_comment','CommentsController@delete_Comment');


// Albums
Route::post('app/create_album','AlbumsController@add_Album');
Route::get('app/get_albums', 'AlbumsController@index');
Route::post('app/edit_album','AlbumsController@edit_Album');
Route::post('app/delete_album','AlbumsController@delete_Album');



// Photos
Route::post('app/create_photo','PhotosController@add_Photo');
Route::get('app/get_photos', 'PhotosController@index');
Route::post('app/edit_photo','PhotosController@edit_Photo');
Route::post('app/delete_photo','PhotosController@delete_Photo');


// Todos
Route::post('app/create_todo','TodosController@add_Todo');
Route::get('app/get_todos', 'TodosController@index');
Route::post('app/edit_todo','TodosController@edit_Todo');
Route::post('app/delete_todo','TodosController@delete_Todo');


// Todos
Route::post('app/create_user','UsersController@add_User');
Route::get('app/get_users', 'UsersController@index');
Route::post('app/edit_user','UsersController@edit_User');
Route::post('app/delete_user','UsersController@delete_User');


Route::get('/', function () {
    return view('dashboard');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::any('{slug}', function(){
    return view('dashboard');
});