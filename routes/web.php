<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\AdminpageController;

// Admin page route
Route::get('/deshboard',[AdminpageController::class,'ShowDeshboardPage'])->name('show.deshboard');

// Admin Auth Routes
Route::get('/admin-login',[AdminAuthController::class,'ShowAdminLoginPage'])->name('admin.login.page');
Route::post('/admin-login',[AdminAuthController::class,'AdminLogin'])->name('admin.login');
