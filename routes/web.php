<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleConroller;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\AdminpageController;
use App\Http\Controllers\admin\PermissionController;

// Admin Auth Routes
Route::group(['middleware' => 'admin.redirect'], function(){
Route::get('/admin-login',[AdminAuthController::class,'ShowAdminLoginPage'])->name('admin.login.page');
Route::post('/admin-login',[AdminAuthController::class,'AdminLogin'])->name('admin.login');
});


// Admin page route
Route::group(['middleware' => 'admin'], function(){
Route::get('/deshboard',[AdminpageController::class,'ShowDeshboardPage'])->name('show.deshboard');
Route::get('/admin-logout',[AdminAuthController::class,'AdminLogout'])->name('admin.logout');

// User permissions Routes
Route::resource('/permission', PermissionController::class);

// User Role Routes
Route::resource('/role', RoleConroller::class);
});

