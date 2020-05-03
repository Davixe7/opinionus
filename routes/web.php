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
  return view('landing', ['surveys'=>App\Survey::with('choices')->get()]);
});

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function(){
  Route::post('choices/storeList', 'Admin\ChoiceController@storeList');
  Route::get('choices/deleteAll', 'Admin\ChoiceController@deleteAll')->name('choices.deleteAll');
  Route::get('surveys/deleteAll', 'Admin\SurveyController@deleteAll')->name('surveys.deleteAll');
  Route::resource('surveys', 'Admin\SurveyController');
  Route::resource('choices', 'Admin\ChoiceController');
  Route::resource('banners', 'Admin\BannerController');
  Route::post('updateLogo', 'Admin\DashboardController@updateLogo')->name('updateLogo');
});

Route::get('/surveys', 'SurveyController@index')->name('surveys.index');
Route::get('/surveys/{slug}/results', 'SurveyController@results')->name('surveys.results');
Route::get('/surveys/{slug}/vote', 'SurveyController@vote')->name('surveys.vote');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/votes', 'VoteController@store')->name('votes.store');