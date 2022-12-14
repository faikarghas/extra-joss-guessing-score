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

//test 



//Route::group(['prefix'=>'dashboard', 'middleware'=> ['web','auth','user-access:admin']], function() {
Route::middleware(['web','auth', 'user-access:admin'])->group(function () {
  //Dashboard
  Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
  Route::get('/leaderboard', [\App\Http\Controllers\Admin\DashboardController::class, 'leaderboard'])->name('dashboard.leaderboard');
  Route::get('/updateScore', [\App\Http\Controllers\Admin\DashboardController::class, 'updateScore'])->name('dashboard.updateScore');
  //Slider
  Route::resource('/sliders', \App\Http\Controllers\Admin\SliderController::class);
  //Categories
  Route::resource('/categories', \App\Http\Controllers\Admin\CategoryController::class);
  Route::get('/categories/select', [\App\Http\Controllers\Admin\CategoryController::class, 'select'])->name('categories.select');
  //Posts
  Route::get('/posts/details/{id}', [\App\Http\Controllers\Admin\PostController::class, 'details'])->name('posts.details');
  Route::resource('/posts', \App\Http\Controllers\Admin\PostController::class);
  Route::resource('/postimages', \App\Http\Controllers\Admin\PostImagesController::class);
  Route::resource('/teams', \App\Http\Controllers\Admin\TeamsController::class);
  Route::resource('/matchs', \App\Http\Controllers\Admin\FmatchController::class);
  Route::resource('/quizs', \App\Http\Controllers\Admin\QuizController::class);
  Route::resource('/quizchoices', \App\Http\Controllers\Admin\QuestionChoiceController::class);
  Route::resource('/users', \App\Http\Controllers\Admin\UserController::class);
  Route::resource('/rounds', \App\Http\Controllers\Admin\RoundController::class);

  Route::get('/startquiz', [\App\Http\Controllers\Admin\StartQuizController::class, 'index']);
  Route::get('/startquiz/getquiz', [\App\Http\Controllers\Admin\StartQuizController::class, 'getquiz']);


  Route::any('/matchs/updatestatus', [\App\Http\Controllers\Admin\FmatchController::class, 'update_status'])->name('matchs.updatestatus');;
  Route::any('/rounds/updatestatus', [\App\Http\Controllers\Admin\RoundController::class, 'update_status'])->name('rounds.updatestatus');;
  

  //User
  // file manager
  Route::group(['prefix' => 'filemanager'], function () {
    UniSharp\LaravelFilemanager\Lfm::routes();
  });
});