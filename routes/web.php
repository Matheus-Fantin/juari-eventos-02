<?php

use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteRequestController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/sobre', function () {
    return view('sobre');
});

Route::get('/galeria', function () {
    return view('galeria');
});

Route::post('/orcamento', [QuoteRequestController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('orcamento.store');

Route::post('/depoimentos', [TestimonialController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('depoimentos.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/depoimentos', [AdminTestimonialController::class, 'index'])->name('testimonials.index');
    Route::patch('/depoimentos/{testimonial}/aprovar', [AdminTestimonialController::class, 'approve'])->name('testimonials.approve');
    Route::patch('/depoimentos/{testimonial}/despublicar', [AdminTestimonialController::class, 'unpublish'])->name('testimonials.unpublish');
    Route::delete('/depoimentos/{testimonial}', [AdminTestimonialController::class, 'destroy'])->name('testimonials.destroy');

    Route::get('/galeria', [AdminGalleryController::class, 'index'])->name('galleries.index');
    Route::post('/galeria', [AdminGalleryController::class, 'store'])->name('galleries.store');
    Route::delete('/galeria/{photo}', [AdminGalleryController::class, 'destroy'])->name('galleries.destroy');
});

require __DIR__.'/auth.php';
