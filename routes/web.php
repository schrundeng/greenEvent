<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

// Auth routes (register, login, logout)
require __DIR__ . '/auth.php';

// Categories (CRUD)
Route::resource('categories', CategoriesController::class);

// User Pages
Route::prefix('user')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('user.dashboard');
    Route::view('/profile', 'user.user-profile')->name('user.profile');
    Route::view('/edit-profile', 'user.user-edit-profile')->name('user.user-edit');
    Route::view('/history', 'user.history')->name('user.history');
    Route::view('/registration', 'user.event-register')->name('user.event-regis');
});


// Admin Pages
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'adminIndex'])->name('admin.dashboard');
    Route::view('/manageusers', 'admin.user-management')->name('admin.user-manage');
    Route::view('/manage/events', 'admin.event-management')->name('admin.event-manage');
    Route::post('/event/store', [EventController::class, 'store'])->name('admin.events-store');
    Route::get('/event/create', [EventController::class, 'create'])->name('admin.create-edit');
    Route::get('/edit/event', [EventController::class, 'edit'])->name('admin.event-edit');
});


// Event Pages
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/event-detail', [EventController::class, 'index'])->name('event.detail.show');
Route::get('/event-register', fn() => view('user.event-register'));
Route::get('/event-detail/{idOrSlug}', [EventController::class, 'show'])->name('events.detail.show');
