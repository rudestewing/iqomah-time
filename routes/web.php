<?php

use Illuminate\Support\Facades\Artisan;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('generate', function() {
    Artisan::call('generate-schedule');
});

Route::
    prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->as('admin.')
    ->group(function() {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('settingBackground', 'SettingBackgroundController');
        Route::resource('homeSlider', 'HomeSliderController');
        Route::resource('time', 'TimeController');
    });

Route::get('/{vue_capture?}', function () { return view('index'); })->where('vue_capture', '[\/\w\.-]*');
