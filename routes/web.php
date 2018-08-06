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



Route::get('/', 'PostsController@index')->name('home');

Route::get('/posts/create', 'PostsController@create');
Route::get('/review', 'PostsController@review');
Route::post('review/{post}', 'PostsController@publish');
Route::post('delete/{post}', 'PostsController@delete');
Route::get('/posts/{post}', 'PostsController@show');
Route::post('/posts', 'PostsController@store');

Route::post('/posts/{post}/comments', 'CommentsController@store');

Route::get('/tasks/{task}', 'TasksController@show');

Route::get('/tasks', 'TasksController@index');
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

#Route::get('/home', 'HomeController@index')->name('home');

Route::get('monsters', 'MonstersController@index');
Route::get('/monsters/{monster}', 'MonstersController@show');
Route::post('/monsters/{monster}', 'MonstersController@writeArticle');
Route::get('featured', 'MonstersController@featured');


Route::get('runes', 'RunesController@index');

Route::get('upload', 'UploadsController@index');
Route::post('upload/json', 'UploadsController@store')->name('upload.json');

Route::get('users/{user}', 'UsersController@profile');
Route::get('users/{user}/units', 'UnitsController@index');
Route::get('json/{json}', 'JSONController@show');
Route::post('json/delete/{json}', 'JSONController@destroy');
Route::get('json/update/{json}', 'JSONController@update');

