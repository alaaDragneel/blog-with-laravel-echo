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


Route::middleware(['admin'])->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');


    // users
    Route::resource('users', 'UsersController');
    Route::post('users/multi_delete', 'UsersController@multi_delete')->name('users.multi_delete');

    // tags
    Route::resource('tags', 'TagsController');
    Route::post('tags/multi_delete', 'TagsController@multi_delete')->name('tags.multi_delete');

    // posts
    Route::resource('posts', 'PostsController');
    Route::post('posts/multi_delete', 'PostsController@multi_delete')->name('posts.multi_delete');

    // roles and permisions
    Route::resource('roles','RoleController');
    Route::post('/roles/multi_delete', 'RoleController@multi_delete')->name('roles.multi_delete');
    Route::resource('permissions', 'PermissionController');
    Route::post('permissions/multi_delete', 'PermissionController@multi_delete')->name('permissions.multi_delete');

});
