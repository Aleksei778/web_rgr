<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Admin;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('main');
})->name('main-page');

Route::get('/about', function () {
    return view('about-company');
})->name('about-company');

Route::get('/news', [NewsController::class, 'index'])->name('news');

Route::get('/location-map', [MapsController::class, 'index'])->name('location-map');

Route::get('/site-map', [AuthController::class, 'showSiteMap'])->name('site-map');

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
    Route::get('/property', [Admin\AdminPropertyController::class, ''])->name('property');
    Route::get('/pages', [Admin\AdminPropertyController::class, 'getPages'])->name('pages');
    Route::get('/property-requests', [Admin\AdminPropertyRequestController::class,'index'])->name('property.requests');
});