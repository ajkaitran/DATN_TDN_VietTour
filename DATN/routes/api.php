<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryArticleController;
use App\Http\Controllers\TourTypeController;
use App\Http\Controllers\TourCategoryController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\StartPlaceController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route tour
Route::get('/tour/list', [TourController::class, 'listTour']);
Route::get('/tour/detail/{id}', [TourController::class, 'getToursById']);
Route::get('/tour/cateType/{cateID}', [TourController::class, 'getTourByCategory']);
Route::get('/tour/search', [TourController::class, 'searchByName']);
//
Route::post('/feedback', [eedBackController::class,'store']);