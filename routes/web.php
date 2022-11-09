<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\GoogleLoginController;
use App\Http\Controllers\Web\FacebookLoginController;
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

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/daftar',[HomeController::class,'daftar'])->name('daftar');
Route::get('/masuk',[HomeController::class,'masuk'])->name('masuk');
Route::get('/lupa',[HomeController::class,'lupapassword'])->name('password.request.custom');
Route::get('/mekanisme',[HomeController::class,'mekanisme'])->name('mekanisme');
Route::get('/hadiah',[HomeController::class,'hadiah'])->name('hadiah');
Route::get('/belanja',[HomeController::class,'belanja'])->name('belanja');
Route::get('/hasil-pertandingan',[HomeController::class,'hasilKlasemen'])->name('hasilPertandingan');



Route::get('/updGuessing',[HomeController::class,'storeGuess'])->name('storeGuess');
Route::get('/upd',[HomeController::class,'update_t'])->name('upd');
Route::get('/klasemen/{offset}/{putaran}',[HomeController::class,'klasemen'])->name('klasemen');

Route::post('/storeRegister',[HomeController::class,'createUser'])->name('storeRegister');
Route::post('/selectCity/{id}', [HomeController::class,'selectCity'])->name('selectcity');

Route::get('reset-password/{token}', [HomeController::class, 'showResetPasswordForm'])->name('reset.password.get');

// Route::get('resetpassword', [HomeController::class, 'showResetPasswordForm'])->name('reset.password.get');

//Route::post('reset-password', [HomeController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::group(['middleware' => ['guest']], function() {
     /* Google Social Login */
    Route::get('/login/google', [GoogleLoginController::class,'redirect'])->name('login.google-redirect');
    Route::get('/login/google/callback', [GoogleLoginController::class,'callback'])->name('login.google-callback');

    /* facebook Login */
    Route::get('/login/facebook', [FacebookLoginController::class, 'redirect'])->name('login.facebook-redirect');
    Route::get('/login/facebook/callback', [FacebookLoginController::class, 'callback'])->name('login.facebook-callback');
});

Auth::routes();


/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/getquiz',[HomeController::class,'getquiz']);
    Route::post('/store-quiz/{id}',[HomeController::class,'storeQuiz']);
    Route::post('/guess-score/{id_match}',[HomeController::class,'storeOrUpdateScore'])->name('sous');
    Route::get('/guess/{id_match}',[HomeController::class,'guess'])->name('gs');
    Route::get('/profil',[HomeController::class,'profil'])->name('profil');
    Route::post('/updateprofile/{id}', [HomeController::class, 'updateprofil'])->name('update.profile');


});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();
    return Redirect::to('/');
})->name('logout');


Route::get('/storage', function(){
    \Artisan::call('storage:link');
    return "storage link sukses";
});




