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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/about', function () {
//     return view('about');
// });
// Route::get('about','aboutController@index');
// Route::get('school','schoolController@index');
// Route::get('administration','administrationController@index');

Route::get('/about','pagesController@about');
Route::get('/school','pagesController@school');
Route::get('/','pagesController@index');

Route::resource('/student','studentController');
Route::resource('/course','courseController');
Route::resource('/administration','adminController');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
