<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController; // Import the new DashboardController

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'redirect_if_admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resource routes for authenticated users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('livres', [LivreController::class, 'index'])->name('livres.index'); // Allow all authenticated users to view books
    Route::get('livres/{livre}', [LivreController::class, 'show'])->name('livres.show'); // Allow authenticated users to view book details
    Route::resource('emprunts', EmpruntController::class);
    Route::post('emprunts/{emprunt}/return', [EmpruntController::class, 'returnBook'])->name('emprunts.return');
    Route::resource('reservations', ReservationController::class);
    Route::post('reservations/{reservation}/cancel', [ReservationController::class, 'cancelReservation'])->name('reservations.cancel');
});

// Admin routes (will require custom 'admin' middleware later)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    // Admin specific book management routes
    Route::get('/livres', [AdminController::class, 'livres'])->name('admin.livres.index'); // Admin's view of all livres
    Route::get('/livres/create', [LivreController::class, 'create'])->name('admin.livres.create');
    Route::post('/livres', [LivreController::class, 'store'])->name('admin.livres.store');
    Route::get('/livres/{livre}/edit', [LivreController::class, 'edit'])->name('admin.livres.edit');
    Route::put('/livres/{livre}', [LivreController::class, 'update'])->name('admin.livres.update');
    Route::get('/livres/{livre}', [LivreController::class, 'show'])->name('admin.livres.show'); // Admin can view specific livre
    Route::delete('/livres/{livre}', [LivreController::class, 'destroy'])->name('admin.livres.destroy');
    Route::get('/emprunts', [AdminController::class, 'emprunts'])->name('admin.emprunts.index');
    Route::get('/emprunts/create', [AdminController::class, 'createEmprunt'])->name('admin.emprunts.create');
    Route::post('/emprunts', [AdminController::class, 'storeEmprunt'])->name('admin.emprunts.store');
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('admin.reservations.index');
    Route::get('/reservations/create', [AdminController::class, 'createReservation'])->name('admin.reservations.create');
    Route::post('/reservations', [AdminController::class, 'storeReservation'])->name('admin.reservations.store');
});

require __DIR__.'/auth.php';
