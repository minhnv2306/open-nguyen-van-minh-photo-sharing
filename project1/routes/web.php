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

Route::get('/', 'ImageController@getImage');

Auth::routes();

Route::get('home', 'ImageController@getImage');

Route::middleware(['auth'])->group(function() {
    Route::get('chooseimage', function() {
        return view('chooseimage');
    });
    Route::resource('images', 'ImageController');
    Route::post('images/create', 'ImageController@create');
    Route::post('moveimage', 'ImageController@moveImage');
    Route::get('storeimage', 'ImageController@storeImage');
    Route::get('editimage/{id}', 'ImageController@showImage');
    Route::post('updateimage', 'ImageController@updateImage');
    Route::get('deleteimage/{id}', 'ImageController@isDeleteImage');
});
Route::get('/error',function() {
   return view('error/404');
});
Route::get('home', 'ImageController@index');
