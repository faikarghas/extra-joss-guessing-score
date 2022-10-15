<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Illuminate\Http\Request;

//use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/



// Route::get('/', function() {
//     print('I am an admin');
// });

//Dashboard
Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
//Slider
Route::resource('/sliders', \App\Http\Controllers\Admin\SliderController::class);
//Categories
Route::resource('/categories', \App\Http\Controllers\Admin\CategoryController::class);
Route::get('/categories/select', [\App\Http\Controllers\Admin\CategoryController::class, 'select'])->name('categories.select');
//Posts
Route::get('/posts/details/{id}', [\App\Http\Controllers\Admin\PostController::class, 'details'])->name('posts.details');
Route::resource('/posts', \App\Http\Controllers\Admin\PostController::class);
Route::resource('/postimages', \App\Http\Controllers\Admin\PostImagesController::class);
//User




