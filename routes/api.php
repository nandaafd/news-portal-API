<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::namespace('Api')->group(function(){
    Route::prefix('auth')->group(function(){
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('register', [RegisterController::class, 'register'])->name('register');
    });
    Route::middleware('auth:api')->group(function(){
        Route::post('logout',[AuthController::class, 'logout']);
        Route::prefix('news')->group(function(){
            Route::get('list', [NewsController::class, 'index']);
            Route::get('{id}', [NewsController::class, 'show']);
            Route::post('store', [NewsController::class, 'store']);
            Route::put('{id}/update', [NewsController::class, 'update']);
            Route::delete('{id}/delete', [NewsController::class, 'destroy']);
        });
        Route::prefix('comment')->group(function(){
            Route::get('list', [CommentController::class, 'index']);
            Route::post('create',[CommentController::class, 'store']);
            Route::get('{id}', [CommentController::class, 'show']);
            Route::put('{id}/update', [CommentController::class, 'update']);
            Route::delete('{id}/delete', [CommentController::class, 'destroy']);
        });
    });
    
    
   
});

