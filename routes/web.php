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



Route::get('/users', 'AdminController@user')->name('users');

Route::get('/users/new', 'AdminController@create')->name('users.create');

Route::post('/users/new', 'AdminController@store')->name('users.store');


Route::get('/users/{user}', 'AdminController@userDetails')
    ->where('user', '[0-9]+')
    ->name('user.details');



Route::get('/projects', 'AdminController@project')->name('projects');

Route::get('/managements', 'AdminController@management')->name('managements');

Route::get('/groups', 'AdminController@group')->name('groups');

