<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::group(['middleware' => ['guest']], function() {
    // Route::get('/register', [AuthController::class, 'register_show'])->name('register.show');
    // Route::post('/register', [AuthController::class, 'register'])->name('register.perform');
    // Route::get('/login', [AuthController::class, 'login_show'])->name('login.show');
    // Route::post('/login', [AuthController::class, 'login'])->name('login.perform');

});

Route::group(['middleware' => ['auth', 'permission']], function() {


    // Route::group(['prefix' => 'users'], function() {
    //     Route::get('/', 'UsersController@index')->name('users.index');
    //     Route::get('/create', 'UsersController@create')->name('users.create');
    //     Route::post('/create', 'UsersController@store')->name('users.store');
    //     Route::get('/{user}/show', 'UsersController@show')->name('users.show');
    //     Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
    //     Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
    //     Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
    // });
    // Route::resource('roles', [RolesController::class]);
    // Route::resource('permissions', [PermissionsController::class]);
});
