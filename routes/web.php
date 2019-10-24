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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');



// Users

Route::get('/users', 'AdminController@user')->name('users');

Route::get('/users/new', 'AdminController@create')->name('user.create');

Route::post('/users/new', 'AdminController@store')->name('user.store');


Route::get('/users/{user}', 'AdminController@details')
    ->where('user', '[0-9]+')
    ->name('user.details');

Route::get('/users/{user}/edit', 'AdminController@edit')
    ->where('user', '[0-9]+')
    ->name('user.edit');

Route::put('/users/{user}/edit', 'AdminController@update')
    ->where('user', '[0-9]+')
    ->name('user.update');

Route::get('users/trash', 'AdminController@trashed')
    ->name('users.trash');

Route::patch('users/{user}/trash', 'AdminController@trash')
    ->where('user', '[0-9]+')
    ->name('user.trash');

Route::patch('users/{id}/restore', 'AdminController@restore')
    ->where('user', '[0-9]+')
    ->name('user.restore');

Route::delete('/users/{id}', 'AdminController@destroy')
    ->where('user', '[0-9]+')
    ->name('user.destory');

// Others
Route::get('/projects', 'AdminController@project')->name('projects');

Route::get('/managements', 'AdminController@management')->name('managements');

Route::get('/groups', 'AdminController@group')->name('groups');

