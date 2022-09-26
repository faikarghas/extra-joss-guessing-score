<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\GoogleLoginController;
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

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/upd',[HomeController::class,'update_t'])->name('upd');


Route::group(['middleware' => ['guest']], function() {
    // /**
    //  * Register Routes
    //  */
    // Route::get('/register', 'RegisterController@show')->name('register.show');
    // Route::post('/register', 'RegisterController@register')->name('register.perform');

    // /**
    //  * Login Routes
    //  */
    // Route::get('/login', 'LoginController@show')->name('login.show');
    // Route::post('/login', 'LoginController@login')->name('login.perform');

     /* Google Social Login */
    Route::get('/login/google', [GoogleLoginController::class,'redirect'])->name('login.google-redirect');
    Route::get('/login/google/callback', [GoogleLoginController::class,'callback'])->name('login.google-callback');

});


Route::post('/guess-score/{id_match}',[HomeController::class,'storeOrUpdateScore'])->name('sous');
Route::get('/guess/{id_match}',[HomeController::class,'guess'])->name('gs');
