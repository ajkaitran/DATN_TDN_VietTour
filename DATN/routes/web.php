<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\TourTypeController;
use App\Http\Controllers\TourCategoryController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\FeedBackController;
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
Route::prefix('admin/article')->middleware('admin')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/store', [ArticleController::class, 'store'])->name('article.store');
    Route::get('/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/{id}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
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
    Route::match(['GET', 'POST'], '/create', [TourTypeController::class, 'create'])->name('tourType.create');
    Route::match(['GET', 'POST'], '/edit/{id}', [TourTypeController::class, 'edit'])->name('tourType.edit');
    Route::get('/{id}', [TourTypeController::class, 'destroy'])->name('tourType.destroy');
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
    Route::match(['GET', 'POST'],'/create', [TourController::class, 'create'])->name('tour.create');
    Route::match(['GET', 'POST'],'/edit/{id}', [TourController::class, 'edit'])->name('tour.edit');
    Route::get('/{id}', [TourController::class, 'destroy'])->name('tour.destroy');
});
Route::prefix('admin/combo')->middleware('admin')->group(function () {
    Route::get('/', [ComboController::class, 'index'])->name('combo.index');
    Route::match(['GET', 'POST'],'/create', [ComboController::class, 'create'])->name('combo.create');
    Route::match(['GET', 'POST'],'/edit/{id}', [ComboController::class, 'edit'])->name('combo.edit');
    Route::get('/{id}', [ComboController::class, 'destroy'])->name('combo.destroy');
});
Route::prefix('admin/startPlace')->middleware('admin')->group(function () {
    Route::get('/', [StartPlaceController::class, 'index'])->name('startPlace.index');
    Route::get('/create', [StartPlaceController::class, 'create'])->name('startPlace.create');
    Route::post('/store', [StartPlaceController::class, 'store'])->name('startPlace.store');
    Route::get('/{id}/edit', [StartPlaceController::class, 'edit'])->name('startPlace.edit');
    Route::put('/{id}', [StartPlaceController::class, 'update'])->name('startPlace.update');
    Route::delete('/{id}', [StartPlaceController::class, 'destroy'])->name('startPlace.destroy');
});
Route::prefix('admin/feedBack')->middleware('admin')->group(function () {
    Route::get('/', [FeedBackController::class, 'index'])->name('feedback.index');
    Route::match(['GET', 'POST'], '/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::match(['GET', 'POST'], '/edit/{id}', [FeedbackController::class, 'edit'])->name('feedback.edit');
    Route::get('/{id}', [FeedBackController::class, 'destroy'])->name('feedback.destroy');
});
