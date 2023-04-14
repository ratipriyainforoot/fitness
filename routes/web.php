<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;

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

//Order route
Route::get('/all-orders',[OrderController::class,'allOrders'])->name('all-orders');
Route::get('/add-orders',[OrderController::class,'addOrders'])->name('add-orders');
Route::post('/add-order-store',[OrderController::class,'addOrderStore'])->name('add-order-store');

//users Route
Route::get('/all-users',[UserController::class,'allUsers'])->name('all-users');
Route::post('/edit-user',[UserController::class,'editUser'])->name('edit-user');
Route::post('/delete-user',[UserController::class,'deleteUser'])->name('delete-user');

//Coupon Route
Route::get('/all-coupon',[CouponController::class,'allCoupon'])->name('all-coupon');
Route::get('/add-coupon',[CouponController::class,'addCoupon'])->name('add-coupon');
Route::post('/add-coupon-store',[CouponController::class,'addCouponStore'])->name('add-coupon-store');
Route::post('/edit-coupon',[CouponController::class,'editCoupon'])->name('edit-coupon');
Route::post('/delete-coupon',[CouponController::class,'deleteCoupon'])->name('delete-coupon');

//Country Route
Route::get('/all-country',[CountryController::class,'allCountry'])->name('all-country');
Route::get('/add-country',[CountryController::class,'addCountry'])->name('add-country');
Route::post('/add-country-store',[CountryController::class,'addCountryStore'])->name('add-country-store');
Route::post('/edit-country',[CountryController::class,'editCountry'])->name('edit-country');
Route::post('/delete-country',[CountryController::class,'deleteCountry'])->name('delete-country');

//State Route
Route::get('/all-state',[StateController::class,'allState'])->name('all-state');
Route::get('/add-state',[StateController::class,'addState'])->name('add-state');
Route::post('/add-state-store',[StateController::class,'addStateStore'])->name('add-state-store');
Route::post('/edit-state',[StateController::class,'editState'])->name('edit-state');
Route::post('/delete-state',[StateController::class,'deleteState'])->name('delete-state');

//City Route
Route::get('/all-city',[CityController::class,'allCity'])->name('all-city');
Route::get('/add-city',[CityController::class,'addCity'])->name('add-city');
Route::post('/add-city-store',[CityController::class,'addCityStore'])->name('add-city-store');
Route::post('/edit-city',[CityController::class,'editCity'])->name('edit-city');
Route::post('/delete-city',[CityController::class,'deleteCity'])->name('delete-city');