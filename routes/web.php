<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
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
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::namespace('App\Http\Controllers')->group(function() {
    Route::get('/', 'HomeController@index');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', 'ProfileController@dashboard')->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/image/list', 'ImageController@index')->name('image.list');
        Route::get('/image/add', 'ImageController@add')->name('image.add');
        Route::post('/image/store', 'ImageController@store')->name('image.store');
        Route::get('/image/edit', 'ImageController@edit')->name('image.edit');
        Route::post('/image/update', 'ImageController@update')->name('image.store');
        Route::post('/image/delete', 'ImageController@delete')->name('image.delete');
    });
});



require __DIR__.'/auth.php';

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin.')->group(function() {
    Route::get('/',function () {
        return redirect(route('admin.dashboard'));
    })->name('home');

    Route::namespace('Auth')->middleware('guest:admin')->group(function(){
        //Login Routes
        Route::get('/login','AuthenticatedSessionController@create')->name('login');
        Route::post('/login','AuthenticatedSessionController@store');

        //Forgot Password Routes
        Route::get('/forgot-password', 'PasswordResetLinkController@create')->name('password.request');
        Route::post('/forgot-password', 'PasswordResetLinkController@store')->name('password.email');

        //Reset Password Routes
        Route::get('/reset-password/{token}', 'NewPasswordController@create')->name('password.reset');
        Route::post('/reset-password', 'NewPasswordController@store')->name('password.update');

        

    });

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard','ProfileController@dashboard')->name('dashboard');
        Route::post('/logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');

        Route::get('/profile', 'ProfileController@edit')->name('profile.edit');
        Route::post('/profile', 'ProfileController@update')->name('profile.update');

        Route::get('/change-password', 'Auth\PasswordController@edit')->name('password.edit');
        Route::post('/change-password', 'Auth\PasswordController@update')->name('password.update');
    });

    //Users Routes
    Route::get('/user','UserController@index')->name('user.list');
    Route::post('/user/ajax', 'UserController@ajax')->name('user.list.ajax');
    Route::get('/user/view/{id}', 'UserController@view')->name('user.view');
});
