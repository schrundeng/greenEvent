<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (register, login, logout)
require __DIR__ . '/auth.php';

// Categories (CRUD)
Route::resource('categories', CategoriesController::class);

// User Pages
Route::prefix('user')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('user.dashboard');
    Route::view('/profile', 'user.user-profile');
    Route::view('/edit-profile', 'user.edit-user-profile');
    Route::view('/history', 'user.history');
});


// Admin Pages
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'adminIndex'])->name('admin.dashboard');
    Route::view('/manage-users', 'admin.user-management');
    Route::view('/manage-events', 'admin.event-management');
    Route::view('/create-event', 'admin.event-create');
    Route::view('/edit-event', 'admin.event-edit');
});


// Event Pages
Route::get('/event-detail', [EventController::class, 'index'])->name('event.detail.show');
Route::get('/event-register', fn() => view('user.event-register'));
Route::get('events/{idOrSlug}', [EventController::class, 'show'])->name('events.detail.show');
