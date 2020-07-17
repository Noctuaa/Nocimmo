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

/*Route::get('/', function () {
    return view('welcome');
});*/



 

/***************************
 * Dashboard Admin
 *************************/

 Route::group([
     'prefix' => 'dashboard',
     'middleware' => 'HtmlMinifier'
 ], function(){
     
     /*** User ***/
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/user/index', 'UserController@index')->name('index.user');
    Route::post('/user/{id}/update', 'UserController@update')->name('update.user');
    Route::get('/user/profile/{slug}', 'UserController@edit')->name('edit.user');
    Route::post('/register', 'Auth\RegisterController@register')->name('register');
    Route::get('/user/register', 'Auth\RegisterController@showRegistrationForm')->name('register.user');
    Route::get('/user/{id}/delete', 'UserController@destroy');

    /*** RealEstate ***/
    Route::get('/property/index', 'RealEstateController@index')->name('index.property');
    Route::get('/property/post', 'RealEstateController@create')->name('add.property');
    Route::post('/property/post', 'RealEstateController@store')->name('store.property');
    Route::get('/property/edit/{name}', 'RealEstateController@edit')->name('edit.property');
    Route::post('/property/update/{id}', 'RealEstateController@update')->name('update.property');
    Route::get('/property/{id}/delete', 'RealEstateController@destroy')->name('destroy.property');
    Route::post('/property/{id}/{url}/{ext}/delete', 'RealEstateController@deleteImage'); 

    /**Equipement ***/
    Route::get('/property/equipment', 'EquipmentController@index')->name('index.equipment');
    Route::post('/property/equipment/post', 'EquipmentController@store')->name('store.equipment');
    Route::post('/property/equipment/delete/{id}', 'EquipmentController@destroy')->name('delete.equipment');
 });


/***************************
 * User
 *************************/
Route::group([
    'middleware' => 'HtmlMinifier'
],function(){

     /*** Auth ***/
    Auth::routes(['register' => false]);

    /*** User ***/
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/{category}/filter', 'RealEstateController@searchFilter')->name('searchFilter');
    Route::get('/{category}', 'RealEstateController@category')->name('category');
    Route::get('/{category}/{name}', 'RealEstateController@show')->name('show.property');
});
