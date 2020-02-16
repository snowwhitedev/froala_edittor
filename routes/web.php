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
    return view('signin');
});

Route::get('user/login', 'UserController@login');
Route::get('user/signup', 'UserController@signup');
Route::get('user/logout', 'UserController@logout');

Route::get('dashboard/', 'DashBoardController@index');

Route::get('dashboard/addUserTree', 'DashBoardController@addUserTree');
Route::get('dashboard/reNameTree', 'DashBoardController@reNameTree');
Route::get('dashboard/moveNode', 'DashBoardController@moveNode');
Route::get('dashboard/deleteTree', 'DashBoardController@deleteTree');
Route::get('dashboard/saveDoc', 'DashBoardController@saveDoc');
Route::get('dashboard/getDoc', 'DashBoardController@getDoc');
Route::get('dashboard/getProjects', 'DashBoardController@getProjects');

Route::get('dashboard/uploadImage', 'DashBoardController@uploadImage');
//Route::match(['get', 'post'],'dashboard/uploadImage', 'DashBoardController@uploadImage');