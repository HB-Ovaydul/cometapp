<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleConroller;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ClientController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\AdminpageController;
use App\Http\Controllers\admin\ContactUsController;
use App\Http\Controllers\admin\ExpertiseController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\Frontend\FrontednController;
use App\Http\Controllers\admin\TestimonialsController;

// Backend Admin Auth Routes
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
// Admin User Routes
Route::resource('/admin-user', AdminController::class);
// Admin Status Update Switch
Route::get('/admin-status-update/{id}', [AdminController::class, 'UpdateStatus'])->name('admin.sta.up'); 
// Admin Users Trash page
Route::get('/admin-trash', [AdminController::class, 'Trash'])->name('admin.trash'); 
Route::get('/admin-trash-update/{id}', [AdminController::class, 'TrashUpdate'])->name('admin.trash.update');
// Slider Routes
Route::resource('/slide',SliderController::class);
Route::get('/trash-slide', [SliderController::class, 'ShowSlideTrash'])->name('slide.tash');
Route::get('/trash-slide/{id}', [SliderController::class, 'TrashForSlide'])->name('slide.move.tash');
Route::get('/status-update-slide/{id}', [SliderController::class, 'statusForSlide'])->name('slide.status');
//Testimonials Routes
Route::resource('/testimonial', TestimonialsController::class);
Route::get('testimonial-trash-page', [TestimonialsController::class, 'TestimonialTrash'])->name('test.trash');
Route::get('testimonial-trash-update/{id}', [TestimonialsController::class, 'TestimonialTrashUpdate'])->name('test.trash.update');
Route::get('testimonial-status-update/{id}', [TestimonialsController::class, 'StatushUpdate'])->name('test.status.update');

// Client Routes
Route::resource('/client', ClientController::class);
Route::get('/client-trash-page', [ClientController::class, 'ClientTrashPage'])->name('client.trash.page');
Route::get('/client-trash-update/{id}', [ClientController::class, 'ClientTrasUdate'])->name('client.trash.update');
Route::get('/client-status-update/{id}', [ClientController::class, 'ClientStatusUdate'])->name('client.status.update');

// Expertise Routes
Route::resource('/expertise', ExpertiseController::class);
Route::get('/expertise-trash-page',[ExpertiseController::class,'ExMoveTrash'])->name('ex.move.trash');
Route::get('/expertise-trash-update/{id}',[ExpertiseController::class,'ExUpdateTrash'])->name('ex.Update.trash');
Route::get('/expertise-status-update/{id}',[ExpertiseController::class,'ExStatusUpdate'])->name('ex.status.update');

// Contact Us Routes
Route::resource('/contact-admin', ContactUsController::class);
Route::get('contact-trash-page',[ContactUsController::class,'ContactTrashPage'])->name('con.trash.page');
Route::get('contact-trash-update/{id}',[ContactUsController::class,'ContactTrashupdate'])->name('con.trash.update');
Route::get('contact-status-update/{id}',[ContactUsController::class,'ContactStatusUpdate'])->name('con.status.update');

});



/**
 * Forntend Pages Routs
 */

 Route::get('/', [FrontednController::class, 'ShowHomePage'])->name('home.page');
 Route::get('/contact', [FrontednController::class, 'ShowCntactPage'])->name('contact.page');

