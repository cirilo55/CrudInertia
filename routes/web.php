<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TransportadoraController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Rotas para Transportadoras
Route::get('/transportadora', [TransportadoraController::class, 'index'])->name('transportadora');
Route::get('/transportadora/{id}', [TransportadoraController::class, 'show'])->name('transportadora.show');
Route::post('/transportadora', [TransportadoraController::class, 'store'])->name('transportadora.store');
Route::put('/transportadora/{id}', [TransportadoraController::class, 'update'])->name('transportadora.update');
Route::delete('/transportadora/{id}', [TransportadoraController::class, 'destroy'])->name('transportadora.destroy');

// Rotas para o perfil do usuário
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rota de autenticação
require __DIR__.'/auth.php';

