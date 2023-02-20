<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

//Admin Route
Route::get('/', function () {
    return view('admin');
})->name('home');
Route::post('/adminLogin',[AdminController::class,'adminLogin'])->name('adminLogin');
Route::get('/adminDashboard',[AdminController::class,'adminDashboard'])->name('adminDashboard');
Route::get('/logout',[AdminController::class,'logout'])->name('logout');

//banner route
Route::get('/all-banner',[BannerController::class,'allBanner'])->name('all-banner');
Route::get('/add-banner',[BannerController::class,'addBanner'])->name('add-banner');
Route::post('/add-banner-store',[BannerController::class,'addBannerStore'])->name('add-banner-store');
Route::post('/edit-banner',[BannerController::class,'editBanner'])->name('edit-banner');
Route::post('/delete-banner',[BannerController::class,'deleteBanner'])->name('delete-banner');

//category route
Route::get('/all-category',[CategoryController::class,'allCategory'])->name('all-category');
Route::get('/add-category',[CategoryController::class,'addCategory'])->name('add-category');
Route::post('/add-category-store',[CategoryController::class,'addCategoryStore'])->name('add-category-store');
Route::post('/edit-category',[CategoryController::class,'editCategory'])->name('edit-category');
Route::post('/delete-category',[CategoryController::class,'deleteCategory'])->name('delete-category');

//Product route
Route::get('/all-products',[ProductController::class,'allProducts'])->name('all-products');
Route::get('/add-product',[ProductController::class,'addProduct'])->name('add-product');
Route::post('/add-product-store',[ProductController::class,'addProductStore'])->name('add-product-store');
