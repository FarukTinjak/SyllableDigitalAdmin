<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ImagesController;
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
    Route::get('dashboard', function() {
        return redirect()->route('dashboard.blog');
    })->name('dashboard');

    Route::get('dashboard/blog', [BlogController::class, 'index'])->name('dashboard.blog');
    Route::get('dashboard/blog/create', [BlogController::class, 'create'])->name('dashboard.blog.create');
    Route::get('dashboard/blog/edit/{id}', [BlogController::class, 'edit'])->name('dashboard.blog.edit');
    Route::post('dashboard/blog/save', [BlogController::class, 'save'])->name('dashboard.blog.save');
    Route::get('dashboard/blog/delete/{id}', [BlogController::class, 'delete'])->name('dashboard.blog.delete');

    Route::post('/images/uploadImageFile', [ImagesController::class, 'uploadImageFile'])->name('images.uploadfile');
    Route::post('/images/uploadImageUrl', [ImagesController::class, 'uploadImageUrl'])->name('images.uploadurl');

    Route::post('signout', [AuthController::class, 'signOut'])->name('signout');
});
