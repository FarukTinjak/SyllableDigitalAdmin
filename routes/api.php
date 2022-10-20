<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/blog', [BlogController::class, 'get'])->name('api.blog.get');
Route::get('/blog/{id}', [BlogController::class, 'getById'])->name('api.blog.getById');
Route::post('/contact', [MailController::class, 'mail'])->name('api.contact');
