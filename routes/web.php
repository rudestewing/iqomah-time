<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::
    prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->as('admin.')
    ->group(function() {
        Route::get('/', function() {
            return redirect()->route('admin.home');
        });

        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('settingBackground', 'SettingBackgroundController');
        Route::resource('homeSlider', 'HomeSliderController');
        Route::resource('time', 'TimeController');
    });

Route::get('/{vue_capture?}', function () { return view('index'); })->where('vue_capture', '[\/\w\.-]*');
