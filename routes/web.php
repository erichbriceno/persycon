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

Route::get('/users', 'UserController@index')
    ->name('users');

Route::get('/users/find', 'UserController@find')
    ->name('user.find');

Route::post('/users/find', 'UserController@finder')
    ->name('user.finder');

Route::get('/users/new/{cedule?}', 'UserController@create')
    ->name('user.create');

Route::post('/users/new', 'UserController@store')
    ->name('user.store');

Route::get('/users/{user}', 'UserController@details')
    ->where('user', '[0-9]+')
    ->name('user.details');

Route::get('/users/{user}/edit', 'UserController@edit')
    ->where('user', '[0-9]+')
    ->name('user.edit');

Route::put('/users/{user}/edit', 'UserController@update')
    ->where('user', '[0-9]+')
    ->name('user.update');

Route::get('users/trash', 'UserController@index')
    ->name('users.trash');

Route::patch('users/{user}/trash', 'UserController@trash')
    ->where('user', '[0-9]+')
    ->name('user.trash');

Route::patch('users/{id}/restore', 'UserController@restore')
    ->where('user', '[0-9]+')
    ->name('user.restore');

Route::delete('/users/{id}', 'UserController@destroy')
    ->where('user', '[0-9]+')
    ->name('user.destory');

// Projects

Route::get('/projects', 'ProjectController@index')
    ->name('projects');

Route::get('/projects/new', 'ProjectController@create')
    ->name('project.create');

Route::post('/projects/store', 'ProjectController@store')
    ->name('project.store');

Route::get('/projects/{project}/edit', 'ProjectController@edit')
    ->where('project', '[0-9]+')    
    ->name('project.edit');

Route::put('/projects/{project}/edit', 'ProjectController@update')
    ->where('project', '[0-9]+')
    ->name('project.update');

Route::patch('projects/{project}/trash', 'ProjectController@trash')
    ->where('project', '[0-9]+')
    ->name('project.trash');


// Others

Route::get('/managements', 'AdminController@management')->name('managements');

Route::get('/groups', 'AdminController@group')->name('groups');

