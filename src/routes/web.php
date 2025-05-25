<?php

use Illuminate\Support\Facades\Route;

//controllers
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\MytrainingsController;

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

Route::get ('/training', [TrainingController::class, 'index']) ->name('trainings');

// Buy training
Route::get('/training/{id}/buy', [TrainingController::class, 'buytraining'])->name('buytraining');
Route::post('/training/{id}/confirm', [TrainingController::class, 'confirmPurchase'])->name('confirmPurchase');

// My Trainings dashboard
Route::get('/mytrainings', [MytrainingsController::class, 'index'])->name('mytrainings');

// Auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
