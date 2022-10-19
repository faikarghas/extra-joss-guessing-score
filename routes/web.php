<?php

use App\Http\Controllers\FacebookLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\GoogleLoginController;
use App\Http\Controllers\Admin\DasboardController;

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
Route::get('/getquiz',[HomeController::class,'getquiz']);
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/upd',[HomeController::class,'update_t'])->name('upd');

Route::get('/ex',[HomeController::class,'ex'])->name('ex');


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

    /* facebook Login */
    Route::get('/login/facebook', [FacebookLoginController::class, 'redirect'])->name('login.facebook-redirect');
    Route::get('/login/facebook/callback', [FacebookLoginController::class, 'callback'])->name('login.facebook-callback');

});


Route::post('/guess-score/{id_match}',[HomeController::class,'storeOrUpdateScore'])->name('sous');
Route::get('/guess/{id_match}',[HomeController::class,'guess'])->name('gs');

Auth::routes();


Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');


/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    //Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();
    return Redirect::to('/');
})->name('logout');