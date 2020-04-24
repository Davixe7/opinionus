<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function(){
  return view('welcome');
});

Route::post('choices/storeList', 'ChoiceController@storeList');
Route::get('choices/deleteAll', 'ChoiceController@deleteAll')->name('choices.deleteAll');
Route::get('surveys/deleteAll', 'SurveyController@deleteAll')->name('surveys.deleteAll');

Route::get('/surveys/{survey}/results', 'SurveyController@results')->name('surveys.results');
Route::get('/surveys/{survey}/vote', 'SurveyController@vote')->name('surveys.vote');

Route::resource('surveys', 'SurveyController');
Route::resource('choices', 'ChoiceController');
Route::resource('banners', 'BannerController');