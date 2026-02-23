<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;


//ユーザー
Route::get('/', [ContactController::class, 'index']);
Route::post('/contact/confirm', [ContactController::class, 'confirm']);
Route::post('/contact/thanks', [ContactController::class, 'store']);
Route::post('/contact/back', [ContactController::class, 'back']);

//管理者
Route::middleware('auth')->group(function () 
{
    Route::get('/admin', [AuthController::class, 'admin']);
    
});
