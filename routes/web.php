<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function() {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function() {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'Login'])->name('login.post');
});

Route::middleware('auth')->group(function() {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('dashboard/blog', [BlogController::class, 'index'])->name('dashboard.blog');
    Route::post('signout', [AuthController::class, 'signOut'])->name('signout');
});
