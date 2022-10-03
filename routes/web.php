<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleConroller;
use App\Http\Controllers\admin\TagController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ClientController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\VisionContriller;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\AdminpageController;
use App\Http\Controllers\admin\ContactUsController;
use App\Http\Controllers\admin\ExpertiseController;
use App\Http\Controllers\admin\PortfolioController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\AboutBannerController;
use App\Http\Controllers\Frontend\FrontednController;
use App\Http\Controllers\admin\CategorypostController;
use App\Http\Controllers\admin\TestimonialsController;
use App\Http\Controllers\admin\PortfolioBannerController;
use App\Http\Controllers\admin\PortfolioCatagoryController;
use App\Http\Controllers\admin\PortfolioWorkTogetherController;

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
Route::get('/contact-trash-page',[ContactUsController::class,'ContactTrashPage'])->name('con.trash.page');
Route::get('/contact-trash-update/{id}',[ContactUsController::class,'ContactTrashupdate'])->name('con.trash.update');
Route::get('/contact-status-update/{id}',[ContactUsController::class,'ContactStatusUpdate'])->name('con.status.update');

// PortFolio Routs
Route::resource('/portfolio', PortfolioController::class);
Route::get('/portfolio-trash-page',[PortfolioController::class,'PortfolioTrashPage'])->name('Port.trash.page');
Route::get('/portfolio-trash-update/{id}',[PortfolioController::class,'PortfolioTrashUpdate'])->name('Port.trash.update');
Route::get('/portfolio-status-update/{id}',[PortfolioController::class,'PortfolioStatusUpdate'])->name('Port.status.update');

// Portfolio Banner Routes
Route::resource('/portfolio-banner', PortfolioBannerController::class);
Route::get('/portfolio-banner-status-update/{id}',[PortfolioBannerController::class,'PortfolioBannerStatusUpdate'])->name('portbanner.status.update');
Route::get('/portfolio-banner-trash-page',[PortfolioBannerController::class,'PortfolioBannerTrashPage'])->name('portbanner.trash.page');
Route::get('/portfolio-banner-trash-update/{id}',[PortfolioBannerController::class,'PortfolioBannerTrashUpdate'])->name('portbanner.trash.update');


// Portfolio Category Routes
Route::resource('/portfolio-category',PortfolioCatagoryController::class);
Route::get('/portfolio-category-trash-page',[PortfolioCatagoryController::class,'PortfolioCategoryTrashPage'])->name('Pc.trash.page');
Route::get('/portfolio-category-trash-update/{id}',[PortfolioCatagoryController::class,'PortfolioCategoryTrashUpdate'])->name('Pc.trash.update');
Route::get('/portfolio-category-status-update/{id}',[PortfolioCatagoryController::class,'PortfolioCategoryStatusUpdate'])->name('Pc.status.update');

// The Vision
Route::resource('/vision',VisionContriller::class);
Route::get('/vision-trash-page',[VisionContriller::class,'VisionTrashPage'])->name('vision.trash.page');
Route::get('/vision-trash-update/{id}',[VisionContriller::class,'VisionTrashupdate'])->name('vision.trash.update');
Route::get('/vision-status-update/{id}',[VisionContriller::class,'VisionStatusupdate'])->name('vision.status.update');

// Portfolio Work Together Routes
Route::resource('/portfolio-work',PortfolioWorkTogetherController::class);
Route::get('/portfolio-work-trash-page',[PortfolioWorkTogetherController::class,'PortWorkTrashPage'])->name('work.trash.page');
Route::get('/portfolio-work-trash-update/{id}',[PortfolioWorkTogetherController::class,'WorkTrashupdate'])->name('work.trash.update');
Route::get('portfolio-work-status-update/{id}',[PortfolioWorkTogetherController::class,'WorkStatusupdate'])->name('work.status.update');

// About Admin Routes
Route::resource('/about-banner',AboutBannerController::class);
Route::get('/banner-status/{id}',[AboutBannerController::class, 'BannerStatus' ])->name('banner.status.update');
Route::get('/banner-trash-page',[AboutBannerController::class, 'BannerTrashPage' ])->name('banner.trash');
Route::get('/banner-trash-update/{id}',[AboutBannerController::class, 'BannerTrashUpdate' ])->name('banner.trash.update');

/**
 *  Blog post, Tag, Category Routs
 */ 
// Categorypost Routes
Route::resource('/categorypost',CategorypostController::class);
Route::get('/categorypost-trash-page',[CategorypostController::class,'CategorypostTrashPage'])->name('categorypost.trash.page');
Route::get('/categorypost-trash-update/{id}',[CategorypostController::class,'categorypostupdate'])->name('categorypost.trash.update');
Route::get('categorypost-status-update/{id}',[CategorypostController::class,'categorypostStatusupdate'])->name('categorypost.status.update');

// Post Tag Routes
Route::resource('/tag',TagController::class);
Route::get('/tag-trash-page',[TagController::class,'TagTrashPage'])->name('tag.trash.page');
Route::get('/tag-trash-update/{id}',[TagController::class,'tagupdate'])->name('tag.trash.update');
Route::get('tag-status-update/{id}',[TagController::class,'TagStatusupdate'])->name('Tag.status.update');

});

/**
 * Forntend Pages Routs
 */

 Route::get('/', [FrontednController::class, 'ShowHomePage'])->name('home.page');
 Route::get('/contact', [FrontednController::class, 'ShowCntactPage'])->name('contact.page');
 Route::get('/about', [FrontednController::class, 'ShowAboutPage'])->name('about.page');
 Route::get('/portfolio-single-page/{slug}', [FrontednController::class, 'ShowSinglePortfolioPage'])->name('port.single.page');
 Route::get('/portfolio-page', [FrontednController::class, 'ShowPortfolioPage'])->name('port.page');

