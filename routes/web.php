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

//get articles. first page
Route::get('/', "ArticlesController@index");
//get articles. page N
Route::get('/page{id}', 'ArticlesController@index');
//create form for a new article
Route::get('/article/new', "ArticlesController@create");
//make a random article
Route::get('/article/random', 'ArticlesController@makeRandomArticle');
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

//show user's articles. first page
Route::get('/user/{id}', 'ArticlesController@showUsersArticles')->name('user.profile');
//show user's articles. page N
Route::get('/user/{id}/page{n}', 'ArticlesController@showUsersArticles');

//show user's comments
Route::get('/user/{id}/comments', 'CommentsController@showUsersComments');
//store a new comment
Route::post('/article/{id}/comment', 'CommentsController@store');


Auth::routes();

//API. Get article's comments by AJAX
Route::get('/article/{id}/comments', "CommentsController@getAllForTheArticle");