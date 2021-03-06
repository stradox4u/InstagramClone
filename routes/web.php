<?php

use Illuminate\Support\Facades\Route;
use App\Mail\NewUserWelcomeMail;
use App\Post;

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

Auth::routes();

/*Route::get('/email', function() {
    return new NewUserWelcomeMail();
});*/

//Route::get('/', 'LoginController@showHome');

Route::post('follow/{user}', 'FollowsController@store');

Route::get('/home', 'PostsController@index');

Route::get('/', 'PostsController@index');

Route::get('/p/create', 'PostsController@create');

Route::post('/p', 'PostsController@store');

Route::get('/p/{post}', 'PostsController@show');

Route::delete('/posts/{post}', 'PostsController@destroy');


Route::get('/profile/{user}', 'ProfilesController@show')->name('profile.show');

Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');

Route::patch('/profile/{user}/', 'ProfilesController@update')->name('profile.update');

Route::get('/get/{user}', 'ProfilesController@destroy');

Route::get('/search', 'SearchController@home');

Route::get('/search/index', 'SearchController@index');
