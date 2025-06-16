<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\MytrainingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DagopvangController;
use App\Http\Controllers\Admin\AvailabilityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\OrderController as adminOrderController;
use App\Http\Controllers\Admin\TrainingController as AdminTrainingController;
use App\Http\Controllers\Admin\ModuleController as AdminModuleController;
use App\Http\Controllers\Admin\MediaController as AdminMediaController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Contact form routes
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

//shop routes
Route::get('/store', [ProductController::class, 'index'])->name('store.index');
Route::get('/store/{product}', [ProductController::class, 'show'])->name('store.show');

//cart routes
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

// Dagopvang routes
Route::get('/dagopvang', [DagopvangController::class, 'index'])->name('dagopvang.index');
Route::get('/dagopvang/afspraak', [DagopvangController::class, 'create'])->name('dagopvang.create');
Route::post('/dagopvang', [DagopvangController::class, 'store'])->name('dagopvang.store');

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

//admin product routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('producten', AdminProductController::class)->parameters([
        'producten' => 'product'
    ]);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/order', [AdminOrderController::class, 'index'])->name('order.index');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('availability', AvailabilityController::class);
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('availability', AvailabilityController::class)->except(['show']);
});

// Admin user routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class);
});

Route::get('/admin/users/{user}/checkprogress', [AdminUserController::class, 'checkProgress'])->name('admin.users.checkprogress');


// Auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';