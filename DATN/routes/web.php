<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TypetourCategory;

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
    // Route::middleware('admin')->group(function () { 
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('register', [AdminController::class, 'register'])->name('admin.register');
    Route::post('register', [AdminController::class, 'postRegister'])->name('admin.postRegister');
    Route::get('change-password', [AdminController::class, 'changePassword'])->name('admin.changePassword');
    Route::put('change-password', [AdminController::class, 'postChange'])->name('admin.postChange');
    Route::post('signout', [AdminController::class, 'signout'])->name('admin.signout');
    // });
});

Route::prefix('admin/banner')->middleware('admin')->group(function () {
    Route::get('/', [BannerController::class, 'index'])->name('banner.index');
    Route::get('/create', [BannerController::class, 'create'])->name('banner.create');
    Route::post('/store', [BannerController::class, 'store'])->name('banner.store');
    Route::get('/{id}/edit', [BannerController::class, 'edit'])->name('banner.edit');
    Route::put('/{id}', [BannerController::class, 'update'])->name('banner.update');
    Route::delete('/{id}', [BannerController::class, 'destroy'])->name('banner.destroy');
});

Route::prefix('admin/TypeCategory')->middleware('admin')->group(function () {
    Route::get('/', [TypetourCategory::class, 'index'])->name('typetour.index');
    Route::match(['GET', 'POST'], '/create', [TypetourCategory::class, 'create'])->name('typetour.create');
    Route::match(['GET', 'POST'], '/edit/{id}', [TypetourCategory::class, 'edit'])->name('typetour.edit');
    Route::get('/{id}', [TypetourCategory::class, 'delete'])->name('typetour.delete');
});
Route::prefix('admin/Feedback')->middleware('admin')->group(function () {
    Route::get('/', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::match(['GET', 'POST'] , '/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::match(['GET', 'POST'],'/edit/{id}', [FeedbackController::class, 'edit'])->name('feedback.edit');
    Route::get('/{id}', [FeedbackController::class, 'delete'])->name('feedback.delete');
});
