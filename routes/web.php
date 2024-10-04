<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EstudianteController;

// Authentication routes
Auth::routes();

// Ruta para redirigir a la página de inicio
Route::get('/', function () {
    return redirect('/home');
});

// Ruta para mostrar la lista de usuarios
Route::get('/home', [UserController::class, 'listUsers'])
    ->middleware('auth')
    ->name('home');

// Rutas para asignar y eliminar roles
Route::post('home/{userId}/assign-role', [UserController::class, 'assignRole'])
    ->middleware('auth')
    ->name('assign.role');

Route::post('home/{userId}/remove-role', [UserController::class, 'removeRole'])
    ->middleware('auth')
    ->name('remove.role');

// Rutas para la gestión de estudiantes
Route::middleware(['auth'])->group(function () {
    Route::get('/estudiantes', [EstudianteController::class, 'index'])->name('estudiantes');
    Route::get('/estudiantes/create', [EstudianteController::class, 'create'])->name('estudiantes.create');
    Route::post('/estudiantes', [EstudianteController::class, 'store'])->name('estudiantes.store');
    Route::get('/estudiantes/{estudiante}/edit', [EstudianteController::class, 'edit'])->name('estudiantes.edit');
    Route::put('/estudiantes/{estudiante}', [EstudianteController::class, 'update'])->name('estudiantes.update');
    Route::delete('/estudiantes/{estudiante}', [EstudianteController::class, 'destroy'])->name('estudiantes.destroy');
});
