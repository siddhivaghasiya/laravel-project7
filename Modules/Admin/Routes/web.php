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

Route::prefix('admin')->group(function() {
    Route::get('/', 'AdminController@index');
});

Route::get('/','Admincontroller@index')->name('admin');

//categories

Route::get('categories/view','CategoriesController@ajaxlisting')->name('categories.listing');

Route::resource('categories','CategoriesController');


//Tags
Route::get('tags/view','TagsController@ajaxlisting')->name('tags.listing');

Route::resource('tags','TagsController');


//blog
Route::get('blog/view','BlogController@ajaxlisting')->name('blog.listing');

Route::resource('blog','BlogController');
