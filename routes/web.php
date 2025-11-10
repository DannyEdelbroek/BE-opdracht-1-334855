<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllergeenController;
use App\Http\Controllers\MagazijnController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LeverantieController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// allergeen routes
// index
Route::get('/allergeen', [AllergeenController::class, 'index'])->name('allergeen.index');
// create
Route::get('/allergeen/create', [AllergeenController::class, 'create']) ->name('allergeen.create');
// store
Route::post('/allergeen', [AllergeenController::class, 'store'])->name('allergeen.store');
// destroy
Route::delete('/allergeen/{id}', [AllergeenController::class, 'destroy'])->name('allergeen.destroy');
// getId to edit page
Route::get('/allergeen/{id}/edit', [AllergeenController::class, 'edit'])->name('allergeen.edit');
// update data
Route::put('/allergeen/{id}', [AllergeenController::class, 'update'])->name('allergeen.update');

// magazuijn routes
// index
Route::get('/magazijn', [MagazijnController::class, 'index'])->name('magazijn.index');

Route::get('/producten/{naam}/allergenen', [ProductController::class, 'show'])
    ->where('naam', '.*')
    ->name('producten.index');

Route::get('/leverancier/{productNaam}/info', [LeverantieController::class, 'show'])
    ->where('productNaam', '.*')
    ->name('leverancier.index');

Route::get('/leverancier', [LeverantieController::class, 'index'])->name('leverancierOverzicht.index');


// dashboard
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

// profile, password, appearance
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
