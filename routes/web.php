<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\eventController as ControllersEventController;
use App\Http\Controllers\RegisController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});
Route::get('/about', function () {
    return view('about');
});

// Auth routes (register, login, logout)
require __DIR__ . '/auth.php';

// Categories (CRUD)
Route::resource('categories', CategoriesController::class);

// User Pages
Route::prefix('user')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/profile', [userController::class, 'profile'])->name('user.profile');
    Route::get('/edit-profile', [userController::class, 'edit'])->name('user.user-edit');
    Route::get('/registration/{idOrSlug}', [RegisController::class, 'create'])->name('user.event-register');
    Route::post('/registration/{idOrSlug}', [RegisController::class, 'store'])->name('user.event-register.store');
    Route::get('/history', [RegisController::class, 'userHistory'])->name('user.event-history');
});


// Admin Pages
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'adminIndex'])->name('admin.dashboard');
    Route::get('/manage/users', [userController::class, 'index'])->name('admin.user-management');
    Route::get('/manage/events', [eventController::class, 'adminIndex'])->name('admin.event-management');
    Route::post('/event/store', [EventController::class, 'store'])->name('admin.events-store');

    Route::get('/event/create', [EventController::class, 'create'])->name('admin.create-edit');
    Route::get('/edit/event/{id}', [EventController::class, 'edit'])->name('admin.event-edit');
    Route::post('/edit/event/update/{id}', [EventController::class, 'update'])->name('admin.event-update');
});


// Event Pages
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/event-detail', [EventController::class, 'index'])->name('event.detail.show');
Route::get('/event-register', [RegisController::class, 'create'])->name('user.event-register');
Route::get('/event-detail/{idOrSlug}', [EventController::class, 'show'])->name('events.detail.show');
