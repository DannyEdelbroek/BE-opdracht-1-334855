<?php

use App\Http\Controllers\Autocontroller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});


Route::middleware(['auth', 'role:leerling'])->group(function () {
    Route::get('/leerling/dashboard', function () {
        return view('leerling.dashboard');
    })->name('leerling.dashboard');
});

Route::middleware(['auth', 'role:Instructeur'])->group(function () {
    Route::get('/instructeur/dashboard', function () {
        return view('instructeur.dashboard');
    })->name('instructeur.dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/users/dashboard', function () {
        return view('users.dashboard');
    })->name('users.dashboard');
});

// Auto routes
Route::middleware(['auth', 'role:Instructeur,Administrator'])->group(function () {
    Route::get('/Auto', [AutoController::class, 'index'])->name('auto.index');
    Route::get('/Auto/show/{id}', [AutoController::class, 'show'])->name('auto.show');
    Route::get('/Auto/edit/{id}', [AutoController::class, 'edit'])->name('auto.edit');
    Route::put('/Auto/update/{id}', [AutoController::class, 'update'])->name('auto.update');
});

Route::middleware('auth')->get('/dashboard', function () {
    $user = Auth::user();

    if ($user->isAdministrator()) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->isInstructeur()) {
        return redirect()->route('instructeur.dashboard');
    }

    if ($user->isLeerling()) {
        return redirect()->route('leerling.dashboard');
    }

    return redirect()->route('users.dashboard');
})->name('dashboard');

Route::middleware('auth')->get('/dashboard', function () {
    $user = Auth::user();

    if ($user->isAdministrator()) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->isInstructeur()) {
        return redirect()->route('instructeur.dashboard');
    }

    if ($user->isLeerling()) {
        return redirect()->route('leerling.dashboard');
    }

    return redirect()->route('users.dashboard');
})->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
