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

//get all articles
Route::get('/', "ArticlesController@index");
//create form for a new article
Route::get('/article/new', "ArticlesController@create");
//show an article
Route::get('/article/{id}', "ArticlesController@show");
//store a new article
Route::post('/article', "ArticlesController@store");
//the edit form for a article
Route::get('/article/{id}/edit', "ArticlesController@edit");
//store an edited article
Route::match(['put', 'patch'], '/article/{id}', "ArticlesController@update");
//delete a article
Route::delete('/article/{id}', "ArticlesController@destroy");



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
