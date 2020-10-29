<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Banner;
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
  $siteconfig = Storage::get('/frontend-config.json');
  return view('landing', [
    'surveys' => App\Survey::with('choices')->limit(10)->get(),
    'siteconfig' => $siteconfig
  ]);
});

Route::get('/home', 'HomeController@index');

// USERS
Route::name('dashboard.')->prefix('dashboard')->middleware('auth:web,admin')->group(function(){
  Route::get('/', 'HomeController@dashboard')->name('index');
  Route::resource('surveys', 'Dashboard\SurveyController');
  Route::resource('choices', 'Dashboard\ChoiceController');
  Route::resource('banners', 'Dashboard\BannerController');
});

// ROOT USER
Route::name('admin.')->prefix('admin')->middleware('auth:admin')->group(function(){
  Route::resource('surveys', 'Admin\SurveyController');
  Route::get('users/{user}/banners', 'Admin\BannerController@index');
  Route::resource('banners', 'Admin\BannerController');
  Route::resource('admin-banners', 'Admin\AdminBannerController')->parameters(['admin-banners' => 'banner']);
  Route::resource('users', 'Admin\UserController');
  Route::post('updateLogo', 'Admin\DashboardController@updateLogo')->name('updateLogo');
  Route::post('siteconfig', 'Admin\FrontendController@store');
  Route::delete('reports/{survey}/ignore','Admin\ReportController@ignore')->name('reports.ignore');
  Route::resource('reports', 'Admin\ReportController');
});

// PUBLIC ROUTES
Route::get('/surveys', 'SurveyController@index')->name('surveys.index');
Route::get('/surveys/{slug}/results', 'SurveyController@results')->name('surveys.results');
Route::get('/surveys/{slug}/vote', 'SurveyController@vote')->name('surveys.vote');
Route::post('/votes', 'VoteController@store')->name('votes.store');
Route::resource('reports', 'ReportController')->only(['create', 'store']);

Route::get('/admin/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.loginform');
Route::post('/admin/login', 'Admin\Auth\LoginController@login')->name('admin.login');
Auth::routes();
