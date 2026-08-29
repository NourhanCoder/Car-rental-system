<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// ==========================================
// User Routes
// ==========================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/', function () {
    return view('main-website.contact');
});


// ==========================================
// Admin Routes
// ==========================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function (){
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('cars', CarController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
});

require __DIR__.'/auth.php';
