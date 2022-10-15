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
Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
//Slider
Route::resource('/sliders', \App\Http\Controllers\SliderController::class);
//Categories
Route::resource('/categories', \App\Http\Controllers\CategoryController::class);
Route::get('/categories/select', [\App\Http\Controllers\CategoryController::class, 'select'])->name('categories.select');
//Posts
Route::get('/posts/details/{id}', [\App\Http\Controllers\PostController::class, 'details'])->name('posts.details');
Route::resource('/posts', \App\Http\Controllers\PostController::class);
Route::resource('/postimages', \App\Http\Controllers\PostImagesController::class);
//User




