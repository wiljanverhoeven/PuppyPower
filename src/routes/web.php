<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\MytrainingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\TrainingController as AdminTrainingController;
use App\Http\Controllers\Admin\ModuleController as AdminModuleController;
use App\Http\Controllers\Admin\MediaController as AdminMediaController;

Route::get('/', function () {
    return view('home');
})->name('home');
// Contact form routes
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

Route::get('/store', [ProductController::class, 'index'])->name('store.index');
Route::get('/store/{product}', [ProductController::class, 'show'])->name('store.show');

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

// My Training Modules
Route::get('/mytrainings/{id}/activetraining', [MytrainingsController::class, 'startTraining'])->name('mytrainings.startTraining');
Route::patch('/mytrainings/{id}/trainingmodule/update', [MytrainingsController::class, 'updateModuleStatus'])->name('mymodules.updateModuleStatus');
Route::get('/mytrainings/{id}/trainingmodule', [MytrainingsController::class, 'startModule'])->name('mymodules.startModule');

// Admin routing
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

// Admin Training routes
Route::prefix('admin')->group(function () {
    Route::resource('trainings', AdminTrainingController::class);
    Route::resource('trainings.modules', AdminModuleController::class);
    Route::resource('trainings.modules.media', AdminMediaController::class);
});


// Auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
