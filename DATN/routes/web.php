<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['prefix'=> ''], function(){
    Route::controller(\App\Http\Controllers\HomeController::class)
        ->name('home.')
        ->group(function (){
            Route::get('/','index')->name('index'); 
        });
});

Route::group(['prefix'=> 'admin'], function(){
    Route::controller(\App\Http\Controllers\AdminController::class)
        ->name('admin.')
        ->group(function (){
            Route::get('login','login')->name('login'); 
            Route::post('login','postLogin')->name('postLogin'); 
        });
    Route::controller(\App\Http\Controllers\AdminController::class)
        ->name('admin.')
        ->middleware('admin')
        ->group(function (){
            Route::get('/','index')->name('index'); 
            Route::get('register','register')->name('register'); 
            Route::post('register','postRegister')->name('postRegister'); 
            Route::get('change-password', 'changePassword')->name('changePassword')->where('id','[0-9]+');; 
            Route::put('change-password', 'postChange')->name('postChange')->where('id','[0-9]+');; 
            Route::post('signout','signout')->name('signout'); 
        });
    Route::controller(\App\Http\Controllers\BannerController::class)
        ->name('banners.')
        ->group(function (){
            Route::get('/banners', 'index')->name('index');
            Route::get('/banners/create', 'create')->name('create');
            Route::post('/banners', 'store')->name('store');
            Route::get('/banners/{id}/edit', 'edit')->name('edit');
            Route::put('/banners/{id}', 'update')->name('update');
            Route::delete('/banners/{id}', 'destroy')->name('destroy');
        });
});