<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

//ユーザー
Route::get('/', [ContactController::class, 'index']);
Route::post('/contact/confirm', [ContactController::class, 'confirm']);
Route::post('/contact/thanks', [ContactController::class, 'store']);
Route::post('/contact/back', [ContactController::class, 'back']);

//管理者
Route::middleware('auth')->group(function () 
{
    Route::get('/admin',  [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/search', [AdminController::class, 'index'])->name('admin.search');
    Route::post('/export', [AdminController::class, 'export'])->name('admin.export');
    Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});
