<?php

use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('main-website.index');
// });

// ==========================================
// User Routes
// ==========================================
Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/payment/checkout/{booking}', [PaymentController::class, 'checkout'])->name('payment.checkout');
});
Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cars', [CarController::class, 'index'])->name('listingcars');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('singlepage');
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/about', function () {
    return view('main-website.about');
})->name('about-us');




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
