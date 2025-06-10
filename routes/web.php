<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('main');
})->name('main-page');

Route::get('/news', [NewsController::class, 'index'])->name('news');

Route::get('/location-map', [MapsController::class, 'index'])->name('location-map');

Route::get('/site-map', [AuthController::class, 'showSiteMap'])->name('site-map');

Route::get('/about', [AboutController::class,'index'])->name('about-company');

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/property', [PropertyController::class, 'index'])->name('property');
    Route::get('/property-form/{property_id}', [PropertyController::class, 'showForm'])->name('property.form');
    Route::post('/proccess_property-form', [PropertyController::class, 'submitPropertyForm'])->name('submit.property.form');

    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Аутентификация
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function() {
    Route::get('/', function () {
        return view('admin.main');
    })->name('main-page');

    Route::resource('news', Admin\AdminNewsController::class);
    
    Route::resource('property', Admin\AdminPropertyController::class);

    Route::get('/pages', [Admin\AdminPagesController::class, 'index'])->name('pages.index');
    
    // History routes
    Route::get('/pages/history/create', [Admin\AdminPagesController::class, 'createHistory'])->name('pages.history.create');
    Route::post('/pages/history', [Admin\AdminPagesController::class, 'storeHistory'])->name('pages.history.store');
    Route::get('/pages/history/{id}/edit', [Admin\AdminPagesController::class, 'editHistory'])->name('pages.history.edit');
    Route::put('/pages/history/{id}', [Admin\AdminPagesController::class, 'updateHistory'])->name('pages.history.update');
    Route::delete('/pages/history/{id}', [Admin\AdminPagesController::class, 'deleteHistory'])->name('pages.history.delete');
    
    // Services routes
    Route::get('/pages/service/create', [Admin\AdminPagesController::class, 'createService'])->name('pages.service.create');
    Route::post('/pages/service', [Admin\AdminPagesController::class, 'storeService'])->name('pages.service.store');
    Route::get('/pages/service/{id}/edit', [Admin\AdminPagesController::class, 'editService'])->name('pages.service.edit');
    Route::put('/pages/service/{id}', [Admin\AdminPagesController::class, 'updateService'])->name('pages.service.update');
    Route::delete('/pages/service/{id}', [Admin\AdminPagesController::class, 'deleteService'])->name('pages.service.delete');
    
    // Awards routes
    Route::get('/pages/award/create', [Admin\AdminPagesController::class, 'createAward'])->name('pages.award.create');
    Route::post('/pages/award', [Admin\AdminPagesController::class, 'storeAward'])->name('pages.award.store');
    Route::get('/pages/award/{id}/edit', [Admin\AdminPagesController::class, 'editAward'])->name('pages.award.edit');
    Route::put('/pages/award/{id}', [Admin\AdminPagesController::class, 'updateAward'])->name('pages.award.update');
    Route::delete('/pages/award/{id}', [Admin\AdminPagesController::class, 'deleteAward'])->name('pages.award.delete');

    Route::get('/property-requests', [Admin\AdminPropertyRequestController::class,'index'])->name('property.requests');
    Route::post('/property-requests/{id}/accept', [Admin\AdminPropertyRequestController::class, 'acceptRequest'])->name('property.accept');
    Route::post('/property-requests/{id}/reject', [Admin\AdminPropertyRequestController::class, 'rejectRequest'])->name('property.reject');
});

Route::get('/locale', [LocaleController::class,'switch'])
    ->name('locale')
    ->middleware('locale');