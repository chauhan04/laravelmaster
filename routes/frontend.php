<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\Auth\ResetPasswordController;

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

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::namespace('Auth')->group(function() {

    Route::get('/login',[LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login',[LoginController::class, 'login'])->name('login.submit');
    Route::get('/register',[RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register',[RegisterController::class, 'register'])->name('register.submit');
    
    Route::get('/logout',[LoginController::class, 'logout'])->name('logout');
    
    Route::get('/forgotpassword',[ForgotPasswordController::class, 'forgotpassword'])->name('forgotpassword');
    Route::post('/forgotpassword',[ForgotPasswordController::class, 'sendForgotPasswordLink'])->name('forgotpassword.link');
    Route::get('/resetpassword/{token}',[ResetPasswordController::class, 'resetpasswordform'])->name('resetpassword.form');
    Route::post('/resetpassword',[ResetPasswordController::class, 'resetpassword'])->name('resetpassword');

});

Route::group(['namespace' => 'App\Http\Controllers\Frontend'], function() {
    /**
    * User Routes
    */
    Route::group(['prefix' => 'user','middleware' => 'auth'], function() {
        Route::get('/dashboard','UserController@dashboard')->name('dashboard');
        Route::get('/profile','UserController@profile')->name('profile');
        Route::get('/profile-edit','UserController@editProfile')->name('profile.edit');
        Route::post('/profile','UserController@saveProfile')->name('profile.update');
        Route::get('/changepassword','UserController@changepassword')->name('changepassword');
        Route::post('/changepassword','UserController@changepasswordsave')->name('changepassword.update');
    });

    /**
    * Pages Routes
    */
    Route::group([], function() {
        Route::get('/aboutus','PagesController@aboutus')->name('aboutus');
        Route::get('/contactus','PagesController@contactus')->name('contactus');
        Route::post('/contactus','PagesController@contactemail')->name('contact.send');
        Route::post('/subscribe','PagesController@subscribe')->name('subscribe');
    });

});