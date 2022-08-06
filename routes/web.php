<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\AdminpageController;

// Admin Auth Routes
Route::group(['middleware' => 'admin.redirect'], function(){
Route::get('/admin-login',[AdminAuthController::class,'ShowAdminLoginPage'])->name('admin.login.page');
Route::post('/admin-login',[AdminAuthController::class,'AdminLogin'])->name('admin.login');
});


// Admin page route
Route::group(['middleware' => 'admin'], function(){
Route::get('/deshboard',[AdminpageController::class,'ShowDeshboardPage'])->name('show.deshboard');
Route::get('/admin-logout',[AdminAuthController::class,'AdminLogout'])->name('admin.logout');
});

