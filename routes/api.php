<?php

use App\Http\Controllers\Api\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::group(['middleware' => ['guest']], function() {
    Route::post('/register', [AuthenticationController::class, 'register'])->name('register.perform');
    Route::post('/login', [AuthenticationController::class, 'login'])->name('login.perform');

});

