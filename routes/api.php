<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\OrderController;





/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/MyProfile',[UserController::class,'MyProfile']);
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::post('/ForgotPasword',[UserController::class,'ForgotPasword']);
Route::post('/ProductList',[ProductController::class,'ProductList']);
Route::post('/product_details',[ProductController::class,'product_details']);
Route::post('/BannerList',[BannerController::class,'BannerList']);
Route::post('/AddToCart',[CartController::class,'AddToCart']);
Route::post('/MyCartList',[CartController::class,'MyCartList']);
Route::post('/AddUserAddress',[AddressController::class,'AddUserAddress']);
Route::post('/MyAddressList',[AddressController::class,'MyAddressList']);
Route::post('/countryList',[CountryController::class,'countryList'])->name('countryList');
Route::post('/stateList',[StateController::class,'stateList'])->name('stateList');
Route::post('/cityList',[CityController::class,'cityList'])->name('cityList');
Route::post('/getCurrentAddress',[AddressController::class,'getCurrentAddress'])->name('getCurrentAddress');
Route::post('/editProfile',[UserController::class,'editProfile'])->name('editProfile');
Route::post('/changePassword',[UserController::class,'changePassword'])->name('changePassword');
Route::post('/placeOrder',[OrderController::class,'placeOrder'])->name('placeOrder');
Route::post('/orderList',[OrderController::class,'orderList'])->name('orderList');

