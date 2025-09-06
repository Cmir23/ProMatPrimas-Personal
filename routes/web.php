<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioRolController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\LoteController; // ← ESTA LÍNEA ES CRUCIAL

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::resource('usuarios', UsuarioController::class);
Route::resource('roles', RolController::class);
Route::resource('usuarioroles', UsuarioRolController::class);

// Agregar estas líneas para lotes
Route::resource('lotes', LoteController::class);
Route::get('/lotes/search', [LoteController::class, 'search'])->name('lotes.search');