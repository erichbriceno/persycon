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

Route::get('/project', 'AdminController@project')->name('projects');

Route::get('/management', 'AdminController@management')->name('managements');

Route::get('/group', 'AdminController@group')->name('groups');

Route::get('/user', 'AdminController@user')->name('users');