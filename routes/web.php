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

use Illuminate\Support\Facades\Route;

Route::get('/', [
  'uses' => 'TasksController@index',
  'as' => 'tasks.index',
]);

Route::group(['prefix' => 'tasks'], function () {
  Route::get('/{id}', [
    'uses' => 'TasksController@show',
    'as' => 'tasks.show',
  ]);

  Route::post('/', [
    'uses' => 'TasksController@store',
    'as' => 'tasks.store',
  ]);

  Route::put('/{id}', [
    'uses' => 'TasksController@update',
    'as' => 'tasks.update',
  ]);

  Route::delete('/{id}', [
    'uses' => 'TasksController@destroy',
    'as' => 'tasks.destroy',
  ]);
});

Route::group(['prefix' => 'comments'], function () {
  Route::get('/{id}', [
    'uses' => 'CommentsController@index',
    'as' => 'comments.index',
  ]);

  Route::post('/add/{id}', [
    'uses' => 'CommentsController@store',
    'as' => 'comments.store',
  ]);
});
