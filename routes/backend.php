<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\Auth\ResetPasswordController;
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
Route::get('/', function () {
    return view('welcome');
});

Route::get('home', [HomeController::class, 'index'])->name('home');
*/

Route::redirect('/', '/admin/dashboard', 301);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth:admin');
//Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::namespace('Auth')->group(function() {

    Route::get('/login',[LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login',[LoginController::class, 'login'])->name('login.submit');
    
    Route::post('/logout',[LoginController::class, 'logout'])->name('logout');
    
    Route::get('/forgotpassword',[ForgotPasswordController::class, 'forgotpassword'])->name('forgotpassword');
    Route::post('/forgotpassword',[ForgotPasswordController::class, 'sendForgotPasswordLink'])->name('forgotpassword.link');
    Route::get('/resetpassword/{token}',[ResetPasswordController::class, 'resetpasswordform'])->name('resetpassword.form');
    Route::post('/resetpassword',[ResetPasswordController::class, 'resetpassword'])->name('resetpassword');

});


Route::group(['namespace' => 'App\Http\Controllers\Backend','middleware' => 'auth:admin'], function() {
    /**
    * Admin Routes
    */
    Route::group(['prefix' => 'admins'], function() {
        Route::get('/', 'AdminsController@index')->name('admins.index');
        Route::get('/create', 'AdminsController@create')->name('admins.create');
        Route::post('/create', 'AdminsController@store')->name('admins.store');
        Route::get('/{admin}/show', 'AdminsController@show')->name('admins.show');
        Route::get('/{admin}/edit', 'AdminsController@edit')->name('admins.edit');
        Route::patch('/{admin}/update', 'AdminsController@update')->name('admins.update');
        Route::delete('/{admin}/delete', 'AdminsController@destroy')->name('admins.destroy');
    });

    /**
    * User Routes
    */
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', 'UsersController@index')->name('users.index');
        Route::get('/create', 'UsersController@create')->name('users.create');
        Route::post('/create', 'UsersController@store')->name('users.store');
        Route::get('/{user}/show', 'UsersController@show')->name('users.show');
        Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
        Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
        Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
    });


});
