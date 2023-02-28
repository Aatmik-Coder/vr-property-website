<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PropertiesController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\DeveloperController;
use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Helper;
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
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('payment-info', 'HomeController@paymentinfo')->name('payment-info');

    Route::middleware('auth')->group(function () {
        // Route::get('/dashboard', 'ProfileController@dashboard')->name('dashboard');
        Route::get('/dashboard', function () {
            return redirect()->to(route('image.list'));
        })->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::put('/change-password', 'Auth\PasswordController@update')->name('password.update');

        Route::get('/image/list', 'ImageController@index')->name('image.list');
        Route::get('/image/add', 'ImageController@add')->name('image.add');
        Route::post('/image/store', 'ImageController@store')->name('image.store');
        Route::get('/image/edit', 'ImageController@edit')->name('image.edit');
        Route::post('/image/update', 'ImageController@update')->name('image.update');
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

        //Users Routes
        Route::resource('users', UserController::class);
        Route::post('/users/ajax', 'UserController@ajax')->name('users.list.ajax');
        // Route::get('/users/view/{id}', 'UserController@view')->name('users.view');
        // Route::delete('delete_data/user/{id}', 'UserController@destroy');
        // Route::resource('users')
        // Route::get('/user/index','UserController@index')->name('users.index');
        // Route::get('/user/create','UserController@create')->name('users.create');
        Route::resource('roles', RoleController::class);
        Route::post('/roles/ajax', 'RoleController@ajax')->name('roles.list.ajax');
        Route::get('/roles/view/{id}', 'RoleController@view')->name('roles.view');
        Route::delete('/roles/delete/{id}', 'RoleController@destroy')->name('roles.destroy');

        //Properties Routes
        Route::resource('properties',PropertiesController::class);
        Route::post('/properties/ajax', 'PropertiesController@ajax')->name('properties.list.ajax');
        Route::get('/properties/view/{id}', 'PropertiesController@view')->name('properties.view');
        Route::delete('/properties/delete/{id}', 'PropertiesController@destroy')->name('properties.destroy');
    
        Route::post('/properties/delete-files',[PropertiesController::class, 'delete_files'])->name('delete-files');

        // Assign Routes
        // Route::get('/')
        
        //Permissinos Routes 
        Route::resource('permissions', PermissionController::class);
        Route::post('/permissions/ajax', 'PermissionController@ajax')->name('permissions.list.ajax');
        Route::get('/permissions/view/{id}', 'PermissionController@view')->name('permissions.view');
        Route::delete('/permissions/delete/{id}', 'PermissionController@destroy')->name('permissions.destroy');
    

        Route::resource('developers', DeveloperController::class);

        Route::resource('agencies', AgencyController::class);

    });
});

Route::prefix('developer')->namespace('App\Http\Controllers\Admin')->name('developer.')->group(function() {
    Route::get('/',function () {
        return redirect(route('developer.dashboard'));
    })->name('home');

    Route::namespace('Auth')->middleware('guest:developer')->group(function(){
        Route::get('/login','AuthenticatedSessionController@developerCreate')->name('login');
        Route::post('/login','AuthenticatedSessionController@developerStore');
    });

    Route::middleware('developer')->group(function () {
        Route::get('/dashboard','DeveloperController@dashboard')->name('dashboard');
        Route::post('/logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');

        Route::get('/profile', 'ProfileController@edit')->name('profile.edit');
        Route::post('/profile', 'ProfileController@update')->name('profile.update');

        Route::get('/change-password', 'Auth\PasswordController@edit')->name('password.edit');
        Route::post('/change-password', 'Auth\PasswordController@update')->name('password.update');

        Route::resource('properties',PropertiesController::class);
        Route::post('/properties/ajax', 'PropertiesController@ajax')->name('properties.list.ajax');
        Route::get('/properties/view/{id}', 'PropertiesController@view')->name('properties.view');
        Route::delete('/properties/delete/{id}', 'PropertiesController@destroy')->name('properties.destroy');
        
        Route::post('/properties/delete-files',[PropertiesController::class, 'delete_files'])->name('delete-files');

        // ASSIGNED PROPERTIES
        Route::get('/assign-properties/index',[DeveloperController::class,'assigned_properties_index'])->name('assign-properties.index');
        Route::post('/assign-properties/ajax', 'DeveloperController@ajax')->name('assign-properties.ajax');
        Route::get('/assign-properties/create', [DeveloperController::class,'assign_properties_create'])->name('assign-properties.create');
        Route::post('/assign-properties/store',[DeveloperController::class,'assigned_properties_store'])->name('assign-properties.store');
    });
});

Route::prefix('agency')->namespace('App\Http\Controllers\Admin')->name('agency.')->group(function() {
    Route::get('/',function () {
        return redirect(route('agency.dashboard'));
    })->name('home');

    Route::namespace('Auth')->middleware('guest:agency')->group(function(){
        Route::get('/login','AuthenticatedSessionController@agencyCreate')->name('login');
        Route::post('/login','AuthenticatedSessionController@agencyStore');
    });

    Route::middleware('agency')->group(function () {
        Route::get('/dashboard','AgencyController@dashboard')->name('dashboard');
        Route::post('/logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');
    });
});

Route::prefix('employee')->namespace('App\Http\Controllers\Admin')->name('employee.')->group(function() {
    Route::get('/',function () {
        return redirect(route('employee.dashboard'));
    })->name('home');

    Route::namespace('Auth')->middleware('guest:employee')->group(function(){
        Route::get('/login','AuthenticatedSessionController@employeeCreate')->name('login');
        Route::post('/login','AuthenticatedSessionController@employeeStore');
    });

    Route::middleware('employee')->group(function () {
        Route::get('/dashboard','EmployeeController@dashboard')->name('dashboard');
        Route::post('/logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');
    });
});

Route::post('fetch-states',[Helper::class,'fetch_states'])->name('fetch-states');

Route::post('fetch-cities', [Helper::class, 'fetch_cities'])->name('fetch-cities');
