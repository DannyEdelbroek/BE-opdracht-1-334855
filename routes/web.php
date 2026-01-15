<?php

use App\Http\Controllers\AllergeenController;
use App\Http\Controllers\MagazijnController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LeverantieController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Allergeen Routes
Route::prefix('allergeen')->name('allergeen.')->group(function() {
    Route::get('/', [AllergeenController::class, 'index'])->name('index');
    Route::get('/create', [AllergeenController::class, 'create'])->name('create');
    Route::post('/', [AllergeenController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [AllergeenController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AllergeenController::class, 'update'])->name('update');
    Route::delete('/{contactId}', [AllergeenController::class, 'destroy'])->name('destroy');
});

// Magazijn Routes
Route::get('/magazijn', [MagazijnController::class, 'index'])->name('magazijn.index');

// Producten / Allergenen per product
Route::get('/producten/{naam}/allergenen', [ProductController::class, 'show'])
    ->where('naam', '.*')
    ->name('producten.index');

// Leverancier Routes
Route::get('/leverancier', [LeverantieController::class, 'index'])->name('leverancier.overzicht');
Route::get('/leverancier/{productNaam}/info', [LeverantieController::class, 'show'])
    ->name('leverancier.index');

// **Specifieke route voor geleverd product eerst**
Route::get('/leverancier/product/{leverdeProduct}/info', [ProductController::class, 'shows'])
    ->name('leverdeProducten.index');
Route::get('/leverancier/{leverancierId}/product/{productId}/levering', [ProductController::class, 'create'])
    ->name('leverdeProducten.create');
Route::post('/leverancier/store', [ProductController::class, 'store'])
    ->name('leverancier.store');
Route::get('/leverancier/Overzicht', [LeverantieController::class, 'indexLeverancier'])
    ->name('leverancier.overzichten');
Route::get('/leverancier/{id}/show', [LeverantieController::class, 'showLeverancier'])
    ->name('leverancier.show');
Route::get('/leverancier/{id}/edit', [LeverantieController::class, 'edit'])
    ->name('leverancier.edit');
Route::put('/leverancier/{id}/update/', [LeverantieController::class, 'update'])
    ->name('leverancier.update');
// Dashboard & settings
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
