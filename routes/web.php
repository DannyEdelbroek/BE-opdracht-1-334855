<?php
use App\Http\Controllers\LeverantieController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeverancierProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');
Route::get('/products/{id}/show', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/LeverancierProduct', [LeverancierProductController::class, 'index'])
    ->name('LeverancierProduct.index');
Route::get('/LeverancierProduct/{id}/show', [LeverancierProductController::class, 'show'])
    ->name('LeverancierProduct.show');
Route::delete('/LeverancierProduct/{id}', [LeverancierProductController::class, 'destroy'])
    ->name('LeverancierProduct.destroy');


Route::get('/leverancier', [LeverantieController::class, 'index'])
    ->name('leverancier.index');
Route::get('/leverancier/{id}/showLeverancier', [LeverantieController::class, 'show'])
    ->name('leverancier.showLeverancier');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
