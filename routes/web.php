<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\eventController as ControllersEventController;
use App\Http\Controllers\RegisController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MagicLinkController;

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
    Route::get('/edit/profile', [userController::class, 'edit'])->name('user.user-edit');
    Route::put('/update-profile', [UserController::class, 'update'])->name('user.user-update');
    Route::get('/registration/{event}', [RegisController::class, 'create'])->name('user.event-register');
    Route::post('/registration/{event}', [RegisController::class, 'store'])->name('user.event-register.store');
    Route::get('/history', [RegisController::class, 'userHistory'])->name('user.event-history');
    Route::get('/event-register', [RegisController::class, 'create'])->name('user.event-register');
});


// Admin Pages
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'adminIndex'])->name('admin.dashboard');
    Route::get('/manage/users', [userController::class, 'index'])->name('admin.user-management');
    Route::get('/manage/users/export', [userController::class, 'export'])->name('admin.users-export');
    Route::get('/manage/events', [eventController::class, 'adminIndex'])->name('admin.event-management');
    Route::get('/manage/events/export', [eventController::class, 'export'])->name('admin.events-export');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');


    Route::post('/event/store', [EventController::class, 'store'])->name('admin.events-store');
    Route::post('/event/destroy/{event}', [EventController::class, 'destroy'])->name('admin.events-destroy');
    Route::get('/event/create', [EventController::class, 'create'])->name('admin.create-edit');
    Route::get('/edit/event/{event}', [EventController::class, 'edit'])->name('admin.event-edit');
    Route::post('/edit/event/update/{event}', [EventController::class, 'update'])->name('admin.event-update');


    Route::get('/manage/registrations/{event}', [RegisController::class, 'index'])->name('admin.event-show-registers');
    Route::post('/manage/registrations/{registration}/change-status', [RegisController::class, 'changeStatus'])
        ->name('admin.registration.change-status');
    Route::delete('/manage/registrations/{registration}/delete', [RegisController::class, 'adminDestroy'])
        ->name('admin.registration.admin-destroy');
});

// Event Pages
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/event-detail', [EventController::class, 'index'])->name('event.detail.index');
Route::get('/event-detail/{event}', [EventController::class, 'show'])->name('events.detail.show');

// Magic Link Authentication
Route::get('/magic-login', [MagicLinkController::class, 'showForm'])->name('magic.login');
Route::post('/magic-login', [MagicLinkController::class, 'sendLink'])->name('magic.send');
Route::get('/magic-login/verify/{token}', [MagicLinkController::class, 'verify'])->name('magic.verify');
