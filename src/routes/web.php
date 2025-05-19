<?php

use Illuminate\Support\Facades\Route;

//controllers
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('home');
});
// Contact form routes
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Training page routes
Route::get('/training', function () {
    return view('training');
})->name('training');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
