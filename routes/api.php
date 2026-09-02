<?php

use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::middleware(['gerenciador.token', 'throttle:60,1'])->group(function () {
    Route::get('/testimonials', [TestimonialController::class, 'index']);
    Route::patch('/testimonials/{testimonial}/approve', [TestimonialController::class, 'approve']);
    Route::patch('/testimonials/{testimonial}/unpublish', [TestimonialController::class, 'unpublish']);
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy']);

    Route::get('/galleries', [GalleryController::class, 'index']);
    Route::post('/galleries/{gallery}/photos', [GalleryController::class, 'storePhoto']);
    Route::delete('/photos/{photo}', [GalleryController::class, 'destroyPhoto']);
});
