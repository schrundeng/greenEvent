<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\EventController;

Route::resource('categories', CategoriesController::class);
Route::get('/', function () {
    return view('landing');
});
// Route::get('/user/dashboard', function () {
//     return view('user.dashboard');
// });

Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

Route::get('/event-detail', function () {
    return view('/user/event-detail');
});
Route::get('/user/profile', function () {
    return view('/user/user-profile');
});
Route::get('/user/edit-profile', function () {
    return view('/user/edit-user-profile');
});
Route::get('/event-register', function () {
    return view('/user/event-register');
});
Route::get('/user/history', function () {
    return view('/user/history');
});
Route::get('events/{idOrSlug}', [EventController::class, 'show'])->name('user.events.show');
