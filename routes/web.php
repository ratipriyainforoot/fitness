<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;

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

Route::get('/', function () {
    return view('admin');
})->name('home');
Route::post('/adminLogin',[AdminController::class,'adminLogin'])->name('adminLogin');
Route::get('/adminDashboard',[AdminController::class,'adminDashboard'])->name('adminDashboard');
Route::get('/all-banner',[BannerController::class,'allBanner'])->name('all-banner');
Route::get('/add-banner',[BannerController::class,'addBanner'])->name('add-banner');
Route::post('/add-banner-store',[BannerController::class,'addBannerStore'])->name('add-banner-store');
Route::get('/logout',[AdminController::class,'logout'])->name('logout');