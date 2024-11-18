<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\TourTypeController;
use App\Http\Controllers\TourCategoryController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\StartPlaceController;

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


Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('login', [AdminController::class, 'postLogin'])->name('admin.postLogin');
    Route::middleware('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('register', [AdminController::class, 'register'])->name('admin.register');
        Route::post('register', [AdminController::class, 'postRegister'])->name('admin.postRegister');
        Route::get('change-password', [AdminController::class, 'changePassword'])->name('admin.changePassword');
        Route::put('change-password', [AdminController::class, 'postChange'])->name('admin.postChange');
        Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::delete('update/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::post('quick-update', [AdminController::class, 'quickUpdate'])->name('admin.quickUpdate');
        Route::delete('destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
        Route::match(['get', 'post'], 'signout', [AdminController::class, 'signout'])->name('admin.signout');
    });
});

Route::prefix('admin/banner')->middleware('admin')->group(function () {
    Route::get('/', [BannerController::class, 'index'])->name('banner.index');
    Route::get('/create', [BannerController::class, 'create'])->name('banner.create');
    Route::post('/store', [BannerController::class, 'store'])->name('banner.store');
    Route::get('/{id}/edit', [BannerController::class, 'edit'])->name('banner.edit');
    Route::put('/{id}', [BannerController::class, 'update'])->name('banner.update');
    Route::delete('/{id}', [BannerController::class, 'destroy'])->name('banner.destroy');
});
Route::prefix('admin/tourType')->middleware('admin')->group(function () {
    Route::get('/', [TourTypeController::class, 'index'])->name('tourType.index');
    Route::get('/create', [TourTypeController::class, 'create'])->name('tourType.create');
    Route::post('/store', [TourTypeController::class, 'store'])->name('tourType.store');
    Route::get('/{id}/edit', [TourTypeController::class, 'edit'])->name('tourType.edit');
    Route::put('/{id}', [TourTypeController::class, 'update'])->name('tourType.update');
    Route::delete('/{id}', [TourTypeController::class, 'destroy'])->name('tourType.destroy');
});
Route::prefix('admin/tourCategory')->middleware('admin')->group(function () {
    Route::get('/', [TourCategoryController::class, 'index'])->name('tourCategory.index');
    Route::get('/create', [TourCategoryController::class, 'create'])->name('tourCategory.create');
    Route::post('/store', [TourCategoryController::class, 'store'])->name('tourCategory.store');
    Route::get('/{id}/edit', [TourCategoryController::class, 'edit'])->name('tourCategory.edit');
    Route::put('/{id}', [TourCategoryController::class, 'update'])->name('tourCategory.update');
    Route::delete('/{id}', [TourCategoryController::class, 'destroy'])->name('tourCategory.destroy');
});
Route::prefix('admin/tour')->middleware('admin')->group(function () {
    Route::get('/', [TourController::class, 'index'])->name('tour.index');
    Route::get('/create', [TourController::class, 'create'])->name('tour.create');
    Route::post('/store', [TourController::class, 'store'])->name('tour.store');
    Route::get('/{id}/edit', [TourController::class, 'edit'])->name('tour.edit');
    Route::put('/{id}', [TourController::class, 'update'])->name('tour.update');
    Route::delete('/{id}', [TourController::class, 'destroy'])->name('tour.destroy');
});
Route::prefix('admin/combo')->middleware('admin')->group(function () {
    Route::get('/', [ComboController::class, 'index'])->name('combo.index');
    Route::get('/create', [ComboController::class, 'create'])->name('combo.create');
    Route::post('/store', [ComboController::class, 'store'])->name('combo.store');
    Route::get('/{id}/edit', [ComboController::class, 'edit'])->name('combo.edit');
    Route::put('/{id}', [ComboController::class, 'update'])->name('combo.update');
    Route::delete('/{id}', [ComboController::class, 'destroy'])->name('combo.destroy');
});
Route::prefix('admin/startPlace')->middleware('admin')->group(function () {
    Route::get('/', [StartPlaceController::class, 'index'])->name('startPlace.index');
    Route::get('/create', [StartPlaceController::class, 'create'])->name('startPlace.create');
    Route::post('/store', [StartPlaceController::class, 'store'])->name('startPlace.store');
    Route::get('/{id}/edit', [StartPlaceController::class, 'edit'])->name('startPlace.edit');
    Route::put('/{id}', [StartPlaceController::class, 'update'])->name('startPlace.update');
    Route::delete('/{id}', [StartPlaceController::class, 'destroy'])->name('startPlace.destroy');
});