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

Route::get('/', 'FrontendController@index');
Route::get('/home', 'FrontendController@index');
Route::get('/tags/{id}/{name?}', 'FrontendController@tags');
Route::get('/post/{slug}', 'FrontendController@single');
Route::get('/save-post/{post_id}', 'FrontendController@savePost');
Route::get('/like-post/{post_id}', 'FrontendController@likePost');
Route::post('/AddComment', 'FrontendController@AddComment');
Route::post('/DeleteComment', 'FrontendController@DeleteComment');
Route::get('/clogout', 'FrontendController@clogout');
Route::post('/search', 'FrontendController@search');
Route::get('/saved-posts', 'FrontendController@savedPosts');
Route::get('/subscribe/tag/{tag_id}', 'FrontendController@subscribe');
Route::get('/fire', function ()
{
	event(new App\Events\SendNotificationsForSubscripers);

	return 'fired';
});
Auth::routes();
