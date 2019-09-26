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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

 
Route::get('/user/register','UserController@register');
Route::get('/user','UserController@index');
Route::get('/user/dashboard','UserController@dashboard');
//Route::get('/user/register','UserController@store');

Route::post('/user/register','UserController@store');
Route::post('/user/login','UserController@login');





Route::group(['middleware'=> 'auth.jwt'],function(){


Route::get('/inventories','InventoryController@getAllIventories');
Route::get('/inventory-create','InventoryController@getForm');
Route::post('/inventory-create','InventoryController@store');
Route::get('/inventory-edit/{id}','InventoryController@getEditForm');
Route::post('/inventory-edit/{id}','InventoryController@updateInventory');
Route::get('/inventory-delete/{id}','InventoryController@deleteInventory');

Route::get('/users','UserController@getAllUsers');

Route::get('admin-create-user','AdminController@getCreatePage');
Route::post('admin-create-user','AdminController@store');
Route::get('admin-edit-user/{id}','AdminController@getEditForm');
Route::post('admin-edit-user/{id}','AdminController@updateUser');
Route::get('admin-delete-user/{id}','AdminController@deleteUser');

Route::post('/user/logout','UserController@logout');
});



