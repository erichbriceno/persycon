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

Route::get('/users/trash', 'UserController@index')
    ->name('users.trash');

Route::patch('/users/{user}/trash', 'UserController@trash')
    ->where('user', '[0-9]+')
    ->name('user.trash');

Route::patch('/users/{id}/restore', 'UserController@restore')
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

Route::patch('/projects/{project}/trash', 'ProjectController@trash')
    ->where('project', '[0-9]+')
    ->name('project.trash');

Route::get('/projects/trash', 'ProjectController@index')
    ->name('projects.trash');

Route::patch('/projects/{id}/restore', 'ProjectController@restore')
    ->where('project', '[0-9]+')
    ->name('project.restore');

Route::delete('/projects/{id}', 'ProjectController@destroy')
    ->where('project', '[0-9]+')
    ->name('project.destory');

// Managemnets

Route::get('/managements', 'ManagementController@index')
    ->name('managements');

Route::get('/managements/trash', 'ManagementController@index')
    ->name('managements.trash');

Route::patch('/managements/{management}/trash', 'ManagementController@trash')
    ->where('management', '[0-9]+')
    ->name('management.trash');

Route::patch('/managements/{id}/restore', 'ManagementController@restore')
    ->where('management', '[0-9]+')
    ->name('management.restore');

Route::delete('/managements/{id}', 'ManagementController@destroy')
    ->where('management', '[0-9]+')
    ->name('management.destory');

Route::get('/managements/new', 'ManagementController@create')
    ->name('management.create');

Route::post('/managements/store', 'ManagementController@store')
    ->name('management.store');

Route::get('/managements/{management}/edit', 'ManagementController@edit')
    ->where('management', '[0-9]+')    
    ->name('management.edit');

Route::put('/managements/{management}/edit', 'ManagementController@update')
    ->where('management', '[0-9]+')
    ->name('management.update');

// Coordinations
Route::get('/coordinations', 'CoordinationController@index')
    ->name('coordinations');

Route::get('/coordinations/trash', 'CoordinationController@index')
    ->name('coordinations.trash');

Route::patch('/coordinations/{coordination}/trash', 'CoordinationController@trash')
    ->where('coordination', '[0-9]+')
    ->name('coordination.trash');

Route::patch('/coordinations/{id}/restore', 'CoordinationController@restore')
    ->where('coordination', '[0-9]+')
    ->name('coordination.restore');

Route::delete('/coordinations/{id}', 'CoordinationController@destroy')
    ->where('coordination', '[0-9]+')
    ->name('coordination.destory');

Route::get('/coordinations/new', 'CoordinationController@create')
    ->name('coordination.create');

Route::post('/coordinations/store', 'CoordinationController@store')
    ->name('coordination.store');

Route::get('/coordinations/{coordination}/edit', 'CoordinationController@edit')
    ->where('coordination', '[0-9]+')    
    ->name('coordination.edit');

Route::put('/coordinations/{coordination}/edit', 'CoordinationController@update')
    ->where('coordination', '[0-9]+')
    ->name('coordination.update');


// Groups

Route::get('/groups', 'GroupController@index')
    ->name('groups');

Route::get('/groups/trash', 'GroupController@index')
    ->name('groups.trash');

Route::patch('/groups/{group}/trash', 'GroupController@trash')
    ->where('group', '[0-9]+')
    ->name('group.trash');

Route::patch('/groups/{id}/restore', 'GroupController@restore')
    ->where('group', '[0-9]+')
    ->name('group.restore');

Route::delete('/groups/{id}', 'GroupController@destroy')
    ->where('group', '[0-9]+')
    ->name('group.destory');

Route::get('/groups/new', 'GroupController@create')
    ->name('group.create');

Route::post('/groups/store', 'GroupController@store')
    ->name('group.store');

Route::get('/groups/{group}/edit', 'GroupController@edit')
    ->where('group', '[0-9]+')    
    ->name('group.edit');

Route::put('/groups/{group}/edit', 'GroupController@update')
    ->where('group', '[0-9]+')
    ->name('group.update');

// Categories

Route::get('/categories', 'CategoryController@index')
->name('categories');

Route::get('/categories/{project}/edit', 'CategoryController@edit')
    ->where('project', '[0-9]+')    
    ->name('category.edit');

Route::put('/categories/{project}/edit', 'CategoryController@update')
    ->where('project', '[0-9]+')
    ->name('category.update');

// Titles

Route::get('/titles', 'TitleController@index')
->name('titles');

Route::get('/titles/{title}/edit', 'TitleController@edit')
    ->where('title', '[0-9]+')    
    ->name('title.edit');