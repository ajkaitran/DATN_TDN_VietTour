<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AssessController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryArticleController;
use App\Http\Controllers\TourTypeController;
use App\Http\Controllers\TourCategoryController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\OnlineCheckoutController;
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

Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/searchTour', [HomeController::class, 'searchTour'])->name('home.searchTour');
    Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('home.detail');
    Route::post('/comments/{id}', [HomeController::class, 'store'])->name('home.comment');
    Route::get('/about', [HomeController::class, 'about'])->name('home.about');
    Route::get('/tourlog/{id}', [HomeController::class, 'tourLog'])->name('home.tourLog');
    Route::get('/blog', [HomeController::class, 'blog'])->name('home.blog');
    Route::get('/blogDetail/{id}', [HomeController::class, 'getBlogById'])->name('home.blogDetail');
    Route::get('/category/{category_type}', [HomeController::class, 'getToursByCategory'])->name('home.tourByCate');
    Route::get('tour', [HomeController::class, 'tour'])->name('home.tour');
    Route::get('register', [HomeController::class, 'register'])->name('home.modal.register');
    Route::post('register', [HomeController::class, 'postRegister'])->name('home.modal.postRegister');
    Route::get('login', [HomeController::class, 'login'])->name('home.modal.login');
    Route::post('login', [HomeController::class, 'postLogin'])->name('home.modal.postLogin');
    Route::match(['get', 'post'], 'logout', [HomeController::class, 'signout'])->name('home.modal.logout');
    Route::middleware('auth:web')->group(function () {
        Route::get('/order/{id}', [HomeController::class,'orderTour'])->name('home.order');
        Route::post('/storeOrder', [HomeController::class, 'storeOrder'])->name('home.storeOrder');
        Route::get('profile', [HomeController::class, 'profile'])->name('home.profile');
        Route::put('change-password', [HomeController::class, 'postChange'])->name('home.postChange');
        Route::put('update/{id}', [HomeController::class, 'updateUser'])->name('home.update');
        Route::post('online-checkout', [OnlineCheckoutController::class, 'online_checkout'])->name('home.onlineCheckout');
        Route::match(['GET','POST'], 'payment/callback', [OnlineCheckoutController::class, 'paymentCallback'])->name('payment.callback');
        Route::get('checkout', [HomeController::class, 'checkout'])->name('home.modal.checkout');
        Route::post('checkout', [HomeController::class, 'postCheckout'])->name('home.modal.postCheckout');
    });
});
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('login', [AdminController::class, 'postLogin'])->name('admin.postLogin');
    Route::middleware('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('register', [AdminController::class, 'register'])->name('admin.register');
        Route::post('register', [AdminController::class, 'postRegister'])->name('admin.postRegister');
        Route::get('change-password', [AdminController::class, 'changePassword'])->name('admin.changePassword');
        Route::put('change-password', [AdminController::class, 'postChange'])->name('admin.postChange');
        Route::get('list-order', [AdminController::class, 'listOrder'])->name('admin.listOrder');
        Route::get('/orderstatistics', [HomeController::class, 'statistics'])->name('admin.orderStatistics');
        Route::post('quick-update-order', [AdminController::class, 'quickUpdateOrder'])->name('admin.quickUpdateOrder');
        Route::get('list-user', [AdminController::class, 'listUser'])->name('admin.listUser');
        Route::get('list-client', [AdminController::class, 'listClient'])->name('admin.listClient');
        Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('update/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::post('quick-update', [AdminController::class, 'quickUpdate'])->name('admin.quickUpdate');
        Route::match(['get', 'post'],'destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
        Route::match(['get', 'post'], 'admin/logout', [AdminController::class, 'signout'])->name('admin.logout');
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
    Route::post('quick-update', [BannerController::class, 'quickUpdate'])->name('banner.quickUpdate');
    Route::delete('/{id}', [BannerController::class, 'destroy'])->name('banner.destroy');
});
Route::prefix('admin/tourType')->middleware('admin')->group(function () {
    Route::get('/', [TourTypeController::class, 'index'])->name('tourType.index');
    Route::match(['GET', 'POST'], '/create', [TourTypeController::class, 'create'])->name('tourType.create');
    Route::match(['GET', 'POST'], '/edit/{id}', [TourTypeController::class, 'edit'])->name('tourType.edit');
    Route::post('quick-update', [TourTypeController::class, 'quickUpdate'])->name('tourType.quickUpdate');
    Route::get('/{id}', [TourTypeController::class, 'destroy'])->name('tourType.destroy');
});
Route::prefix('admin/tourCategory')->middleware('admin')->group(function () {
    Route::get('/', [TourCategoryController::class, 'index'])->name('tourCategory.index');
    Route::get('/create', [TourCategoryController::class, 'create'])->name('tourCategory.create');
    Route::post('/store', [TourCategoryController::class, 'store'])->name('tourCategory.store');
    Route::get('/{id}/edit', [TourCategoryController::class, 'edit'])->name('tourCategory.edit');
    Route::put('/{id}', [TourCategoryController::class, 'update'])->name('tourCategory.update');
    Route::post('quick-update', [TourCategoryController::class, 'quickUpdate'])->name('tourCategory.quickUpdate');
    Route::delete('/{id}', [TourCategoryController::class, 'destroy'])->name('tourCategory.destroy');
});
Route::prefix('admin/tour')->middleware('admin')->group(function () {
    Route::get('/', [TourController::class, 'index'])->name('tour.index');
    Route::match(['GET', 'POST'], '/create', [TourController::class, 'create'])->name('tour.create');
    Route::match(['GET', 'POST'], '/edit/{id}', [TourController::class, 'edit'])->name('tour.edit');
    Route::post('quick-update', [TourController::class, 'quickUpdate'])->name('tour.quickUpdate');
    Route::get('/{id}', [TourController::class, 'destroy'])->name('tour.destroy');
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
    Route::get('/create', [FeedBackController::class, 'create'])->name('feedback.create');
    Route::post('/store', [FeedBackController::class, 'store'])->name('feedback.store');
    Route::get('/{id}/edit', [FeedBackController::class, 'edit'])->name('feedback.edit');
    Route::put('/{id}', [FeedBackController::class, 'update'])->name('feedback.update');
    Route::delete('/{id}', [FeedBackController::class, 'destroy'])->name('feedback.destroy');
});

Route::prefix('admin/assess')->middleware('admin')->group(function () {
    Route::get('/', [AssessController::class, 'index'])->name('assess.index');
});

Route::prefix('admin/comments')->middleware('admin')->group(function () {
    Route::get('/', [CommentController::class, 'index'])->name('comment.index');
    Route::put('/{id}', [CommentController::class, 'update'])->name('comment.update');
});

Route::prefix('admin/articleCategory')->middleware('admin')->group(function () {
    Route::get('/', [CategoryArticleController::class, 'index'])->name('categoryArticle.index');
    Route::get('/create', [CategoryArticleController::class, 'create'])->name('categoryArticle.create');
    Route::post('/store', [CategoryArticleController::class, 'store'])->name('categoryArticle.store');
    Route::get('/{id}/edit', [CategoryArticleController::class, 'edit'])->name('categoryArticle.edit');
    Route::put('/{id}', [CategoryArticleController::class, 'update'])->name('categoryArticle.update');
    Route::delete('/{id}', [CategoryArticleController::class, 'destroy'])->name('categoryArticle.destroy');
});
