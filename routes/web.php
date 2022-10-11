<?php
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

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'Login'])->name('login.post');

Route::middleware('auth')->group(function() {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('signout', [AuthController::class, 'signOut'])->name('signout');
});
